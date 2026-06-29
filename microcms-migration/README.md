# 鵜飼工業サイト microCMS 移管プラン

WordPress テーマ `ukai-kogyo` を microCMS（ヘッドレスCMS）へ移管し、
エックスサーバー上で **WordPress非依存のスタンドアロンPHP** として動かすための設計・移行データ一式。

---

## 1. 可能性分析（結論：実現性が高い）

このサイトはヘッドレス化に向いた構造をしている。

| 判定軸 | 状況 | リスク |
|---|---|---|
| カスタム投稿タイプ / ACF | **未使用**。複雑なフィールド設計がない | 低 |
| プラグイン依存 | コンタクトはGoogleフォーム。動的機能は実質「お知らせ投稿」のみ | 低 |
| フロント技術 | 純粋な HTML / CSS / vanilla JS（React等の依存なし） | 低 |
| 構造化コンテンツ | Works/FAQ/Voice は PHP配列・HTMLベタ書き → 構造が明快 | 低 |
| 画像 | `assets/` 配下に整理済み。`uploads/` に日本語名の混在あり | 中（要リネーム） |

### コンテンツの持ち方（現状）

| コンテンツ | 現在の保持場所 | 件数 | 移行先 microCMS API |
|---|---|---|---|
| お知らせ（News） | WordPress標準投稿（本番DB） | 投稿数次第 | `news`（リスト） |
| 施工事例（Works） | `functions.php` の PHP配列 | 21件 | `works`（リスト） |
| よくある質問（FAQ） | `page-faq.php` の HTML | 22問 / 5カテゴリ | `faq`（リスト） |
| お客様の声（Voice） | `page-home.php` の HTML | 5件 | `voice`（リスト） |
| 会社情報・トップ・問い合わせ | 静的 | — | 移行不要（PHP固定ページ） |

---

## 2. 移行後アーキテクチャ（エックスサーバー × 流用最大化）

```
[microCMS]  ──Content API(JSON)──▶  [エックスサーバー上のPHP]  ──▶  既存のHTML/CSS/JSで描画
   ▲                                      │
   │ 入稿（管理画面）                       └─ ファイルキャッシュ（TTL）でAPI呼び出しを削減
```

- 既存の `page-*.php` の **HTML骨格・CSS・JSはそのまま流用**。
- 差し替えるのは「データ取得部」だけ：
  - `WP_Query` → microCMS Content API（`news`）
  - `ukai_works_items()` の配列 → microCMS Content API（`works`）
  - FAQ/Voice の HTMLベタ書き → microCMS Content API（`faq` / `voice`）
- WordPress関数（`get_header()` 等）は素のPHP `include` に置換。
- API応答は `cache/` にJSONキャッシュ（例：10分TTL）＋ microCMS Webhookでキャッシュ破棄 → 表示速度とAPIレート両立。

### なぜ静的ジェネレータ（Next/Astro）にしないか
「既存HTML/CSS/JSの流用最大化」「エックスサーバー（PHP）」という条件では、
PHPランタイム取得が最も流用率が高く、ビルド基盤も不要なため。
（将来的にAstro等へ移す余地は残る。）

---

## 3. microCMS スキーマ設計

`schema/` に microCMS「スキーマからインポート」用JSONを用意。

### `news`（お知らせ・リスト形式）
| fieldId | 種類 | 説明 |
|---|---|---|
| title | テキスト | 見出し |
| category | セレクト | イベント情報 / 施工事例 / お知らせ |
| body | リッチエディタ | 本文 |
| eyecatch | 画像 | アイキャッチ（任意） |

※ `publishedAt` は microCMS 標準フィールドを使用。

### `works`（施工事例・リスト形式）
| fieldId | 種類 | 説明 |
|---|---|---|
| title | テキスト | 事例タイトル |
| image | 画像 | メイン画像 |
| taste | セレクト | modern / japanese / garden / natural / civil |
| categories | セレクト(複数) | new-exterior, concrete, fence, carport, approach, turf, garden, block, civil |
| tags | テキスト(繰り返し) | 表示用タグ（例：新築外構） |
| description | テキストエリア | 説明文 |
| location | テキスト | 所在地（※現在は非表示。データのみ保持） |

### `faq`（よくある質問・リスト形式）
| fieldId | 種類 | 説明 |
|---|---|---|
| question | テキスト | 質問 |
| answer | テキストエリア | 回答 |
| category | セレクト | consult / cost / work / design / after |

### `voice`（お客様の声・リスト形式）
| fieldId | 種類 | 説明 |
|---|---|---|
| comment | テキストエリア | コメント |
| customerName | テキスト | 表記名（例：Kさま） |
| image | 画像 | サムネイル |

---

## 4. 移行データ

`data/` に投入用JSONを用意（Works/FAQ/Voice は本テーマから抽出済み）。

- `data/works.json` … 21件（画像は `imageFile` に既存アセットの相対パスを記載）
- `data/faq.json` … 22問
- `data/voice.json` … 5件

> News は実投稿が **本番WordPressのDB** にあるため、本テーマからは抽出不可。
> 本番サイトの REST API（`/wp-json/wp/v2/posts?_embed`）からエクスポートして変換する（次工程）。

---

## 5. 推奨ステップ

1. **(今ここ) スキーマ設計＋移行データ準備** ← 本フォルダ
2. microCMS でサービス作成 → `schema/*.json` をインポートして4API作成
3. 画像を microCMS メディアへアップロード（または `assets/` をエックスサーバーにそのまま置き、画像はサイト相対URLで参照）
4. `data/*.json` を Write API で一括投入（投入スクリプトは別途用意可）
5. 本番WordPressから News をエクスポート → 変換 → 投入
6. テーマを WordPress非依存PHPへ改修（API取得＋キャッシュ）
7. エックスサーバーへデプロイ・動作確認（表示速度・404・OGP・サイトマップ）

---

## 6. 確認が必要な事項（次工程の前に）

- microCMS のプラン（API数・転送量上限。無料枠だとAPI数3で足りない可能性 → 4API必要）
- 画像の置き場所：microCMSメディア vs エックスサーバー直置き（流用優先ならサーバー直置きが楽）
- 独自ドメイン・現行URL構造の維持（`/news/{slug}` 等）とリダイレクト方針
- お問い合わせを現行Googleフォーム継続か、エックスサーバーのPHPメールフォーム化するか

# 鵜飼工業 スタンドアロン版（microCMS × エックスサーバー）

WordPress非依存のPHPサイト。`news` は microCMS から取得、`works/faq/voice` は現状静的（既存テーマと同一表示）。
ローカル検証済み：全ページ描画OK・microCMS実接続OK（news 217件）・PHPエラーなし。

## 構成

```
xserver-build/                 ← エックスサーバーの公開ディレクトリ（例: ukai-kogyo.jp/public_html）へ丸ごとアップロード
├── index.php / works.php / faq.php / company.php / contact.php / news.php / news-detail.php
├── .htaccess                  ← きれいなURL（/news/{id}/ 等）と inc/cache/data の保護
├── inc/
│   ├── config.php             ← microCMS接続設定（★gitignore・要キー再発行）
│   ├── config.sample.php      ← 設定テンプレート
│   ├── microcms.php           ← APIクライアント＋ファイルキャッシュ
│   ├── functions-lite.php     ← 表示ヘルパー（works配列含む・静的）
│   ├── wp-shim.php            ← WP互換シム＋news投稿ループ＋title出力
│   ├── bootstrap.php / header.php / footer.php
├── templates/                 ← 各ページ本体（既存テーマから流用）
├── css/ js/ assets/           ← 既存の静的アセット（流用）
├── data/                      ← works/faq/voice フォールバックJSON（将来のmicroCMS化用）
└── cache/                     ← APIキャッシュ（自動生成・gitignore）
```

## デプロイ手順（エックスサーバー）

1. `xserver-build/` の中身を ukai-kogyo.jp の公開ディレクトリへアップロード（FTP/ファイルマネージャ）。
2. PHP は 8.0 以上を選択（cURL拡張が有効であること。エックスサーバーは標準で有効）。
3. `inc/config.php` の値を確認（`service_id` = `ukai-news`／`api_key`）。
4. `cache/` ディレクトリに書き込み権限（755/775）があることを確認。
5. `https://ukai-kogyo.jp/` で表示確認。`/news/`・記事詳細・`/works/`・`/faq/` を一通り確認。

## ⚠️ セキュリティ（必須）

- 現在の API キーは**チャットに平文で露出**したため、**公開前に microCMS 管理画面で再発行**し、`inc/config.php` を更新してください。
- `inc/` `cache/` `data/` `config.php` は `.htaccess` で直アクセス禁止済み。`config.php` は git 追跡外。

## キャッシュ

- `cache_ttl`（既定600秒）で API 応答をファイルキャッシュ。
- 記事更新を即時反映したい場合は `cache/` 内のファイルを削除、または microCMS の Webhook で `cache/` を空にする仕組みを後で追加可能。

## 今後（works / faq / voice の microCMS 化）

1. microCMS で `works` `faq` `voice` API を作成（`microcms-migration/schema/*.json` をインポート）。
2. `microcms-migration/data/*.json` を Write API で投入（投入スクリプトは別途作成可）。
3. 画像をアップロード。
4. `functions-lite.php` の `ukai_works_items()` と各テンプレートを microCMS 取得（`ukai_collection()` 経由）へ差し替え。
   - 現状は `ukai_collection()` が API 404 時に `data/*.json` へ自動フォールバックするため、API作成後はそのまま切替可能。

## 既知の差分（WordPress版との違い）

- news に**カテゴリが無い**（microCMS側未定義）ため、全件「お知らせ」表示。カテゴリ運用するなら news API に `category` セレクトを追加し、`ukai_post_news_category()` を実装で対応。
- お問い合わせは現状 Google フォーム（既存仕様）。

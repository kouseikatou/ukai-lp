<?php
/**
 * 鵜飼工業 LP テーマ
 *
 * @package UkaiKogyo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* =============================================================================
   テーマセットアップ
   ============================================================================= */

if ( ! function_exists( 'ukai_setup' ) ) :
	function ukai_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
		register_nav_menus(
			array(
				'primary' => '主要ナビゲーション',
				'footer'  => 'フッターナビゲーション',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'ukai_setup' );

/* =============================================================================
   スタイル / スクリプトのエンキュー
   ============================================================================= */

function ukai_enqueue_assets() {
	$theme_uri    = get_template_directory_uri();
	$ver          = '1.0.0';

	// Google Fonts
	wp_enqueue_style(
		'ukai-google-fonts',
		'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;600;700&family=Noto+Serif+JP:wght@400;500;600;700&family=Cormorant+Garamond:wght@300;400;500;600&family=Lora:wght@400;500;600&display=swap',
		array(),
		null
	);

	// 共通 CSS
	wp_enqueue_style( 'ukai-styles', $theme_uri . '/css/styles.css', array(), $ver );

	// 全サブページ共通: works.css（元 LP で全ページが参照している共通レイアウト）
	if ( ! is_front_page() ) {
		wp_enqueue_style( 'ukai-works', $theme_uri . '/css/works.css', array( 'ukai-styles' ), $ver );
	}

	// ページ別 CSS
	if ( is_page( 'company' ) ) {
		wp_enqueue_style( 'ukai-company', $theme_uri . '/css/company.css', array( 'ukai-styles' ), $ver );
	}
	if ( is_page( 'contact' ) ) {
		wp_enqueue_style( 'ukai-contact', $theme_uri . '/css/contact.css', array( 'ukai-styles' ), $ver );
	}
	if ( is_page( 'faq' ) ) {
		wp_enqueue_style( 'ukai-faq', $theme_uri . '/css/faq.css', array( 'ukai-styles' ), $ver );
	}
	if ( is_page( 'news' ) ) {
		wp_enqueue_style( 'ukai-news', $theme_uri . '/css/news.css', array( 'ukai-styles' ), $ver );
	}
	if ( is_page( 'works' ) ) {
		wp_enqueue_style( 'ukai-works-cta', $theme_uri . '/css/works-cta.css', array( 'ukai-styles' ), $ver );
	}

	// menu / animations は最後（順序を LP と合わせる）
	wp_enqueue_style( 'ukai-menu',       $theme_uri . '/css/menu.css',       array( 'ukai-styles' ), $ver );
	wp_enqueue_style( 'ukai-animations', $theme_uri . '/css/animations.css', array( 'ukai-styles' ), $ver );

	// 共通 JS
	wp_enqueue_script( 'ukai-script',     $theme_uri . '/js/script.js',     array(), $ver, true );
	wp_enqueue_script( 'ukai-menu-js',    $theme_uri . '/js/menu.js',       array(), $ver, true );
	wp_enqueue_script( 'ukai-animations', $theme_uri . '/js/animations.js', array(), $ver, true );

	// JS にテーマ URI / アセット URI / ホーム URL を渡す
	$ukai_data = sprintf(
		'window.UKAI = { theme: %s, assets: %s, home: %s };',
		wp_json_encode( $theme_uri ),
		wp_json_encode( $theme_uri . '/assets' ),
		wp_json_encode( trailingslashit( home_url( '/' ) ) )
	);
	wp_add_inline_script( 'ukai-script', $ukai_data, 'before' );
	wp_add_inline_script( 'ukai-menu-js', $ukai_data, 'before' );

	// ページ別 JS
	if ( is_page( 'contact' ) ) {
		wp_enqueue_script( 'ukai-contact-js', $theme_uri . '/js/contact.js', array(), $ver, true );
	}
	if ( is_page( 'news' ) ) {
		wp_enqueue_script( 'ukai-news-js', $theme_uri . '/js/news.js', array(), $ver, true );
	}
	if ( is_page( 'works' ) ) {
		wp_enqueue_script( 'ukai-works-js', $theme_uri . '/js/works.js', array(), $ver, true );
	}
}
add_action( 'wp_enqueue_scripts', 'ukai_enqueue_assets' );

/* =============================================================================
   テーマ有効化時：必要なページを自動作成
   ============================================================================= */

function ukai_create_pages_on_activation() {
	$pages = array(
		'home'    => array( 'title' => 'ホーム',          'template' => 'page-home.php' ),
		'company' => array( 'title' => '会社概要',        'template' => 'page-company.php' ),
		'contact' => array( 'title' => 'お問い合わせ',    'template' => 'page-contact.php' ),
		'faq'     => array( 'title' => 'よくあるご質問',  'template' => 'page-faq.php' ),
		'news'    => array( 'title' => 'ニュース',        'template' => 'page-news.php' ),
		'works'   => array( 'title' => '施工事例',        'template' => 'page-works.php' ),
	);

	$home_id = 0;
	foreach ( $pages as $slug => $page ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			if ( 'home' === $slug ) {
				$home_id = $existing->ID;
			}
			continue;
		}
		$id = wp_insert_post(
			array(
				'post_title'     => $page['title'],
				'post_name'      => $slug,
				'post_status'    => 'publish',
				'post_type'      => 'page',
				'post_content'   => '',
				'page_template'  => $page['template'],
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
			)
		);
		if ( 'home' === $slug && $id && ! is_wp_error( $id ) ) {
			$home_id = $id;
		}
	}

	// フロントページ設定
	if ( $home_id ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
	}

	// パーマリンク設定（投稿名）
	update_option( 'permalink_structure', '/%postname%/' );
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ukai_create_pages_on_activation' );

/* =============================================================================
   ニュース用カテゴリ（イベント情報 / 施工事例 / お知らせ）を自動作成
   ============================================================================= */

/**
 * カテゴリ slug → 表示色クラス・日本語ラベル対応表
 * 他のテンプレートからもこの 1 個を参照する
 */
function ukai_news_categories() {
	return array(
		'event' => array(
			'name'        => 'イベント情報',
			'description' => '相談会・展示会など、鵜飼工業が開催するイベント情報',
			'tag_class'   => 'tag-event',
		),
		'works' => array(
			'name'        => '施工事例',
			'description' => '新しく公開した施工事例のお知らせ',
			'tag_class'   => 'tag-works',
		),
		'info'  => array(
			'name'        => 'お知らせ',
			'description' => '休業日・サイトリニューアル・繁忙期対応など全般のお知らせ',
			'tag_class'   => 'tag-info',
		),
	);
}

function ukai_ensure_news_categories() {
	foreach ( ukai_news_categories() as $slug => $cfg ) {
		if ( ! term_exists( $slug, 'category' ) ) {
			wp_insert_term(
				$cfg['name'],
				'category',
				array(
					'slug'        => $slug,
					'description' => $cfg['description'],
				)
			);
		}
	}
}
add_action( 'after_switch_theme', 'ukai_ensure_news_categories' );
add_action( 'init', 'ukai_ensure_news_categories' );

/**
 * 投稿のカテゴリ slug を 1 つだけ取得（最初に見つかったニュースカテゴリ）
 */
function ukai_post_news_category( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	$cats    = get_the_terms( $post_id, 'category' );
	if ( empty( $cats ) || is_wp_error( $cats ) ) {
		return null;
	}
	$known = array_keys( ukai_news_categories() );
	foreach ( $cats as $cat ) {
		if ( in_array( $cat->slug, $known, true ) ) {
			return $cat;
		}
	}
	return $cats[0];
}

/**
 * ニュースカテゴリの色クラスを返す（tag-event / tag-works / tag-info）
 */
function ukai_news_tag_class( $slug ) {
	$map = ukai_news_categories();
	return isset( $map[ $slug ] ) ? $map[ $slug ]['tag_class'] : 'tag-info';
}

/* =============================================================================
   サンプル記事の投入（管理画面: ツール > ニュースのサンプル投入）
   ============================================================================= */

function ukai_sample_posts_data() {
	return array(
		array( '2026-05-20', 'event', '5月25日・26日｜ガーデン相談会を開催します', '岡崎本社にて、外構・お庭のお悩みを直接ご相談いただける相談会を開催。専属プランナーが現地調査からプランニングまで丁寧にご案内いたします。',
			"<p>このたび鵜飼工業 岡崎本社ショールームにて、外構・お庭づくりに関する無料相談会を開催いたします。新築外構のご検討中のお客様、リフォームをご予定のお客様、まずはイメージから相談したいという方まで、お気軽にお越しください。</p>\n\n<h2>開催概要</h2>\n<ul>\n<li><strong>日程</strong>: 2026年5月25日(土)・26日(日) 10:00〜17:00</li>\n<li><strong>会場</strong>: 鵜飼工業 岡崎本社ショールーム</li>\n<li><strong>参加費</strong>: 無料（ご予約優先）</li>\n<li><strong>所要時間</strong>: 1組あたり 60〜90分</li>\n</ul>\n\n<h2>相談会でできること</h2>\n<p>専属プランナーがお客様のご希望やお住まいの状況をお伺いし、その場でラフプランをご提案。施工事例の現物サンプル（石材・ウッドフェンス・タイル等）をご覧いただけます。</p>\n<ul>\n<li>図面やお見積もりをお持ちの方は、より具体的なご提案が可能です</li>\n<li>お子様連れも歓迎。キッズスペースをご用意しております</li>\n<li>ご希望の方には現地調査の日程調整も承ります</li>\n</ul>\n\n<h2>ご予約方法</h2>\n<p>お電話またはお問い合わせフォームよりご予約ください。当日のご来場も歓迎しておりますが、混雑時はお待ちいただく場合がございます。</p>" ),
		array( '2026-05-10', 'works', 'ナチュラルガーデンの施工事例を追加しました', '石畳のアプローチに季節の植栽を組み合わせた、家族で楽しめるナチュラルガーデンを施工。詳しくは施工事例ページでご紹介しています。',
			"<p>愛知県岡崎市M様邸にて、ナチュラルテイストのお庭が完成しました。お客様のご希望は「家族でのんびり過ごせて、季節の移ろいを感じられるお庭」。植栽計画から石材選定まで、丁寧に作り込みました。</p>\n\n<h2>施工のポイント</h2>\n<ul>\n<li>アプローチは乱形石をランダムに配置し、自然な動線を演出</li>\n<li>シンボルツリーにアオダモを採用、株立ちの軽やかな樹形がアクセントに</li>\n<li>下草には常緑のリュウノヒゲと季節の宿根草をミックスし、年間を通じて表情豊かに</li>\n<li>ウッドデッキはハードウッド（イペ材）を使用、メンテナンス性と耐久性を両立</li>\n</ul>\n\n<h2>お客様のご感想</h2>\n<blockquote>「打ち合わせの段階から私たちの暮らし方を丁寧にヒアリングしてくれて、本当に住んでみたい庭が形になりました。週末の楽しみが一つ増えました。」</blockquote>\n\n<p>詳しい施工事例は施工事例ページにてご紹介しています。同じテイストでのご相談もお気軽にどうぞ。</p>" ),
		array( '2026-04-28', 'info',  'ゴールデンウィーク休業のお知らせ', '5月3日(日)〜5月6日(水)はゴールデンウィーク休業とさせていただきます。期間中のお問い合わせは、5月7日(木)以降に順次ご対応いたします。',
			"<p>平素より格別のご愛顧を賜り、誠にありがとうございます。<br/>誠に勝手ながら、下記の期間をゴールデンウィーク休業とさせていただきます。</p>\n\n<h2>休業期間</h2>\n<p><strong>2026年5月3日(日) 〜 5月6日(水)</strong></p>\n<p>5月7日(木)より通常営業いたします。</p>\n\n<h2>お問い合わせについて</h2>\n<p>休業期間中にいただいたお問い合わせ・ご相談につきましては、5月7日(木)以降に順次ご対応させていただきます。お急ぎのお客様にはご不便をおかけいたしますが、何卒ご理解のほどよろしくお願い申し上げます。</p>" ),
		array( '2026-04-15', 'works', 'シンボルツリーが映える玄関施工を追加しました', '愛知県豊田市K様邸。ヤマボウシのシンボルツリーが季節を感じさせる、明るい玄関アプローチが完成しました。',
			"<p>愛知県豊田市K様邸の玄関アプローチ施工が完了しました。シンプルでありながら、四季の移ろいを楽しめる外構を目指しました。</p>\n\n<h2>デザインのコンセプト</h2>\n<p>シンボルツリーにヤマボウシを採用。春の白い花、夏の濃い緑、秋の紅葉と赤い実、冬の枝ぶりと、一年を通じて表情の変化が楽しめる樹種です。建物のホワイト基調の外壁とのコントラストも考慮しました。</p>\n\n<h2>仕様</h2>\n<ul>\n<li>アプローチ: 大判タイル張り（オフホワイト系）</li>\n<li>シンボルツリー: ヤマボウシ（株立ち H2.5m）</li>\n<li>低木: ヒメシャリンバイ、アベリアホープレイズ</li>\n<li>下草: タマリュウ、ヒューケラ</li>\n<li>照明: ガーデンライト 3灯（夜間自動点灯）</li>\n</ul>" ),
		array( '2026-04-05', 'event', '春の植栽フェアを開催（4月12日・13日）', '春におすすめの植栽を集めた展示会を開催。シンボルツリーや低木、季節の花苗まで、お庭づくりのヒントが見つかります。',
			"<p>春の訪れに合わせて、植栽フェアを開催します。シンボルツリー、低木、宿根草、ハーブまで、春に植えたい樹種を一堂に集めました。</p>\n\n<h2>開催日時</h2>\n<p>2026年4月12日(土)・13日(日) 10:00〜17:00<br/>会場: 鵜飼工業 岡崎本社</p>\n\n<h2>当日の見どころ</h2>\n<ul>\n<li>春の人気シンボルツリー10種を展示（ヤマボウシ・アオダモ・シマトネリコ ほか）</li>\n<li>植栽プランナーによる無料相談コーナー</li>\n<li>植え付け・剪定の実演（11時／14時の2回）</li>\n<li>ご来場特典: 季節の花苗プレゼント（先着30名様）</li>\n</ul>" ),
		array( '2026-03-28', 'works', 'ウッドデッキのある暮らし｜施工事例', '家族でくつろげるウッドデッキを中心とした、外と中をつなぐ庭づくりの施工事例をご紹介します。',
			"<p>リビングとお庭をつなぐウッドデッキを中心に、家族の時間が広がる外構をご提案しました。</p>\n\n<h2>こだわったポイント</h2>\n<ul>\n<li>リビング床面とウッドデッキの段差をなくし、室内外がフラットにつながる設計</li>\n<li>素材はメンテナンス性を重視してハードウッドを採用</li>\n<li>道路側には目隠しフェンスを設け、プライベート感を確保</li>\n<li>夜は間接照明でカフェのような雰囲気に</li>\n</ul>\n\n<p>「外で食事をしたり、子どもがプールで遊んだり、休日の過ごし方が変わりました」とお喜びの声をいただいています。</p>" ),
		array( '2026-03-10', 'info',  '公式Instagramを開設しました', '日々の施工事例や現場の様子を発信する公式Instagramを開設しました。ぜひフォローをお願いします。',
			"<p>このたび、鵜飼工業の公式Instagramアカウントを開設いたしました。日々の施工現場の様子、完成後のお庭、季節の植栽情報など、外構・お庭づくりに役立つ情報を発信してまいります。</p>\n\n<h2>こんな投稿をしています</h2>\n<ul>\n<li>最新の施工事例（ビフォーアフター）</li>\n<li>季節のおすすめ植栽</li>\n<li>現場の進捗・職人の手仕事</li>\n<li>イベント・キャンペーン情報</li>\n</ul>\n\n<p>アカウント名: <strong>@ukai_kogyo</strong><br/>ぜひフォロー・「いいね」をお願いいたします。</p>" ),
		array( '2026-02-18', 'event', '無料外構相談会｜2月22日(土)・23日(日)', '予約制の無料外構相談会を開催。図面・お見積もりをご持参いただくと、より具体的なご提案が可能です。',
			"<p>新築外構をご検討中のお客様向けに、予約制の無料相談会を開催いたします。経験豊富なプランナーが、ご予算・ご希望・敷地条件を踏まえて最適なプランをご提案します。</p>\n\n<h2>こんな方におすすめ</h2>\n<ul>\n<li>これから外構工事を検討される方</li>\n<li>他社のお見積もりと比較検討したい方</li>\n<li>具体的なイメージはまだないが、相談から始めたい方</li>\n</ul>\n\n<h2>持ち物（任意）</h2>\n<ul>\n<li>建物の配置図・敷地図</li>\n<li>お住まいの外観写真</li>\n<li>他社のお見積もり（ある場合）</li>\n</ul>" ),
		array( '2026-02-05', 'works', '和モダンの門周り｜施工事例を追加', '塗り壁と植栽を組み合わせた、落ち着いた和モダンの門周りが完成しました。',
			"<p>愛知県西尾市の新築邸宅にて、和モダンテイストの門周り工事が完成しました。</p>\n\n<h2>デザインの特徴</h2>\n<ul>\n<li>塗り壁（ジョリパット）による柔らかな表情</li>\n<li>シンボルツリーにイロハモミジを配し、季節感を演出</li>\n<li>足元は那智黒石の洗い出しでアクセント</li>\n<li>表札・ポストはマットブラックの金属系で引き締め</li>\n</ul>\n\n<p>派手さを抑えながらも、上質な存在感が漂う門周りに仕上がりました。</p>" ),
		array( '2026-01-20', 'info',  'サイトリニューアルのお知らせ', 'この度、コーポレートサイトをリニューアルいたしました。施工事例やサービス情報をより分かりやすくご覧いただけます。',
			"<p>平素より鵜飼工業をご愛顧いただき、誠にありがとうございます。<br/>このたび、よりお客様にご利用いただきやすいよう、コーポレートサイトを全面リニューアルいたしました。</p>\n\n<h2>リニューアルのポイント</h2>\n<ul>\n<li>施工事例ギャラリーをカテゴリ別に整理し、検索しやすく</li>\n<li>お客様の声・FAQ ページを新設</li>\n<li>スマートフォンでの閲覧性を大幅に改善</li>\n<li>お問い合わせフォームの入力項目を見直し</li>\n</ul>\n\n<p>今後ともサイトを通じて有益な情報を発信してまいります。引き続きどうぞよろしくお願いいたします。</p>" ),
		array( '2026-01-05', 'info',  '新年のご挨拶｜本年もよろしくお願いいたします', '旧年中は格別のご愛顧を賜り、誠にありがとうございました。本年も社員一同、お客様の理想の暮らしづくりに精進してまいります。',
			"<p>謹んで新春のお慶びを申し上げます。<br/>旧年中は格別のご愛顧を賜り、誠にありがとうございました。</p>\n\n<p>本年も「お客様の理想の暮らしを、お庭から」を合言葉に、社員一同、丁寧な仕事を積み重ねてまいります。</p>\n\n<p>本年も鵜飼工業をどうぞよろしくお願いいたします。</p>\n\n<p>2026年 元旦<br/>株式会社鵜飼工業 一同</p>" ),
		array( '2025-12-20', 'info',  '年末年始休業のお知らせ', '12月29日〜1月4日は年末年始休業とさせていただきます。期間中のお問い合わせは1月5日以降にご対応いたします。',
			"<p>誠に勝手ながら、下記の期間を年末年始休業とさせていただきます。</p>\n\n<h2>休業期間</h2>\n<p><strong>2025年12月29日(月) 〜 2026年1月4日(日)</strong></p>\n<p>2026年1月5日(月)より通常営業いたします。</p>\n\n<p>休業期間中にいただいたお問い合わせは、1月5日以降に順次ご対応いたします。何卒ご理解のほどよろしくお願い申し上げます。</p>" ),
		array( '2025-12-05', 'works', 'クリスマスを彩るライティング外構｜施工事例', '夜の表情も美しい、ライティングを取り入れた外構の施工事例をご紹介します。',
			"<p>クリスマスシーズンに合わせて、ライティング外構の施工事例をご紹介します。昼の表情とはまったく違う、幻想的な夜のお庭をぜひご覧ください。</p>\n\n<h2>採用した照明</h2>\n<ul>\n<li>シンボルツリー用アップライト（LED 暖色系）</li>\n<li>植栽足元のスポットライト</li>\n<li>アプローチを照らすボラード型ガーデンライト</li>\n<li>建物外壁を柔らかく照らす間接照明</li>\n</ul>\n\n<p>明るすぎず、影と光のバランスを考えた設計が、上品な夜景を生み出します。</p>" ),
		array( '2025-11-10', 'event', '秋のガーデンフェスタ｜11月15日(土)・16日(日)', '紅葉シーズンに合わせた展示会を開催。秋におすすめの植栽や外構プランをご紹介します。',
			"<p>紅葉シーズンに合わせ、秋のガーデンフェスタを開催いたします。</p>\n\n<h2>イベント内容</h2>\n<ul>\n<li>紅葉が美しい樹種の展示（イロハモミジ・ドウダンツツジ・ナツハゼ ほか）</li>\n<li>秋〜冬におすすめの植栽プラン提案</li>\n<li>暖炉・ファイヤーピットのある外構展示</li>\n<li>ホットドリンク・焼き芋のおもてなし</li>\n</ul>\n\n<p>ご家族でゆったりとお過ごしいただけるイベントです。お気軽にお立ち寄りください。</p>" ),
		array( '2025-10-18', 'works', '目隠しフェンスのあるプライベートガーデン', '人目を気にせず家族の時間を楽しめる、ウッドフェンスを使ったプライベートガーデンの施工事例。',
			"<p>道路に面した立地でも、家族だけの時間を楽しめるプライベートガーデンを実現した事例です。</p>\n\n<h2>プライバシーを守る工夫</h2>\n<ul>\n<li>視線の高さに合わせた縦格子ウッドフェンス（H1.8m）</li>\n<li>フェンス内側に常緑樹を配し、二重の目隠しに</li>\n<li>フェンスの一部にスリットを入れ、風と光は通す設計</li>\n</ul>\n\n<p>「子どもをプール遊びさせても安心」「外を気にせず読書ができる」とご好評いただいています。</p>" ),
		array( '2025-09-25', 'info',  '秋の繁忙期に伴う対応について', '秋の繁忙期につき、ご相談からお見積もり提出まで通常より日数をいただく場合がございます。',
			"<p>いつも鵜飼工業をご利用いただき、ありがとうございます。</p>\n\n<p>秋は外構・お庭工事のご依頼が集中する繁忙期となっております。誠に勝手ながら、以下の点にご理解をお願いいたします。</p>\n\n<ul>\n<li>現地調査のご訪問は通常より2〜3週間先となる場合があります</li>\n<li>お見積もり提出までに通常より日数をいただく場合があります</li>\n<li>工事着工は1〜2か月先からのご案内となります</li>\n</ul>\n\n<p>お急ぎのご事情がある場合は、お問い合わせ時にその旨お知らせください。可能な限り柔軟に対応させていただきます。</p>" ),
	);
}

function ukai_import_sample_news_posts() {
	ukai_ensure_news_categories();

	$imported = 0;
	$skipped  = 0;
	foreach ( ukai_sample_posts_data() as $row ) {
		list( $date, $cat_slug, $title, $excerpt, $body ) = $row;

		// 既存判定（タイトル一致）
		$existing = get_page_by_title( $title, OBJECT, 'post' );
		if ( $existing ) {
			$skipped++;
			continue;
		}

		$cat_term = get_term_by( 'slug', $cat_slug, 'category' );
		$cat_ids  = $cat_term ? array( (int) $cat_term->term_id ) : array();

		$post_id = wp_insert_post(
			array(
				'post_title'    => $title,
				'post_name'     => $date . '-' . $cat_slug, // 英数字スラッグ（衝突は WP が自動回避）
				'post_content'  => $body,
				'post_excerpt'  => $excerpt,
				'post_status'   => 'publish',
				'post_type'     => 'post',
				'post_date'     => $date . ' 10:00:00',
				'post_date_gmt' => get_gmt_from_date( $date . ' 10:00:00' ),
				'post_category' => $cat_ids,
			),
			true
		);
		if ( ! is_wp_error( $post_id ) ) {
			// 未来日時のものは WP が自動的に "future" にするため強制的に publish へ
			$current = get_post_status( $post_id );
			if ( 'publish' !== $current ) {
				wp_update_post( array( 'ID' => $post_id, 'post_status' => 'publish' ) );
			}
			$imported++;
		}
	}

	return array( 'imported' => $imported, 'skipped' => $skipped );
}

/* 管理画面: ツール > ニュースのサンプル投入 */
function ukai_register_sample_tool_page() {
	add_management_page(
		'ニュースのサンプル投入',
		'ニュースのサンプル投入',
		'manage_options',
		'ukai-sample-news',
		'ukai_render_sample_tool_page'
	);
}
add_action( 'admin_menu', 'ukai_register_sample_tool_page' );

function ukai_render_sample_tool_page() {
	$result = null;
	if ( isset( $_POST['ukai_sample_action'] ) && check_admin_referer( 'ukai_sample_news_action' ) ) {
		if ( 'import' === $_POST['ukai_sample_action'] ) {
			$result = ukai_import_sample_news_posts();
		}
	}
	?>
	<div class="wrap">
		<h1>ニュースのサンプル記事を投入</h1>
		<p>「イベント情報」「施工事例」「お知らせ」のサンプル記事 16 件を投稿として登録します。<br>
		すでに同じタイトルの投稿があるものはスキップされます。</p>
		<?php if ( $result ): ?>
			<div class="notice notice-success"><p>
				完了しました。
				新規追加: <strong><?php echo (int) $result['imported']; ?></strong> 件 ／
				スキップ: <strong><?php echo (int) $result['skipped']; ?></strong> 件
			</p></div>
		<?php endif; ?>
		<form method="post">
			<?php wp_nonce_field( 'ukai_sample_news_action' ); ?>
			<input type="hidden" name="ukai_sample_action" value="import" />
			<p><button type="submit" class="button button-primary">サンプル記事を投入する</button></p>
		</form>
		<hr>
		<p><a href="<?php echo esc_url( admin_url( 'edit.php' ) ); ?>">→ 投稿一覧へ</a></p>
	</div>
	<?php
}

/* =============================================================================
   ニュース関連: テンプレート判定とアセット読み込みの調整
   ============================================================================= */

/**
 * 単一投稿でも news.css を読み込む
 */
function ukai_enqueue_singular_news_assets() {
	if ( is_singular( 'post' ) ) {
		$theme_uri = get_template_directory_uri();
		$ver       = '1.0.0';
		wp_enqueue_style( 'ukai-news', $theme_uri . '/css/news.css', array( 'ukai-styles' ), $ver );
		wp_enqueue_style( 'ukai-news-detail', $theme_uri . '/css/news-detail.css', array( 'ukai-styles' ), $ver );
	}
}
add_action( 'wp_enqueue_scripts', 'ukai_enqueue_singular_news_assets', 20 );

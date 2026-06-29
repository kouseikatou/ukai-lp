<?php
/**
 * 鵜飼工業 スタンドアロン版 表示ヘルパー（WordPress functions.php から移植）
 * ルート相対URL前提（サイトはドメイン直下に配置）。
 */

/** アセットURL（更新時刻クエリ付き、ルート相対） */
function ukai_asset_uri($relative_path) {
    $relative_path = '/' . ltrim($relative_path, '/');
    $file          = dirname(__DIR__) . $relative_path;
    $version       = is_file($file) ? filemtime($file) : null;
    return $version ? ($relative_path . '?v=' . $version) : $relative_path;
}

function ukai_current_page_slug() { return $GLOBALS['UKAI_PAGE'] ?? ''; }
function ukai_is_home_page()      { return (($GLOBALS['UKAI_PAGE'] ?? '') === 'home'); }

function ukai_contact_url() {
    return 'https://docs.google.com/forms/d/e/1FAIpQLScjo7hymKSQXotVILgv59LAVYHmarkRy0b6zLCGdoaRWXskug/viewform';
}
function ukai_contact_link_attrs() {
    $url = ukai_contact_url();
    if (stripos($url, 'http') === 0) return ' target="_blank" rel="noopener noreferrer"';
    return '';
}

function ukai_social_links() {
    return array(
        array('label' => 'YouTube',   'url' => ''),
        array('label' => 'Instagram', 'url' => 'https://www.instagram.com/ukaikogyo_?utm_source=qr'),
        array('label' => 'TikTok',    'url' => ''),
    );
}

/** ニュース区分（microCMS の news にはカテゴリが無いため既定は info=お知らせ） */
function ukai_news_categories() {
    return array(
        'event' => array('name' => 'イベント情報', 'description' => '', 'tag_class' => 'tag-event'),
        'works' => array('name' => '施工事例',     'description' => '', 'tag_class' => 'tag-works'),
        'info'  => array('name' => 'お知らせ',     'description' => '', 'tag_class' => 'tag-info'),
    );
}
function ukai_news_tag_class($slug) {
    $map = ukai_news_categories();
    return isset($map[$slug]) ? $map[$slug]['tag_class'] : 'tag-info';
}
/** microCMS news はカテゴリ無し → 常に null（テンプレ側で「お知らせ」既定にフォールバック） */
function ukai_post_news_category($post_id = null) { return null; }

function ukai_nav_items() {
    $is_home = ukai_is_home_page();
    return array(
        array('label' => '施工事例',         'href' => $is_home ? '#works'   : '/works/',     'slug' => 'works'),
        array('label' => 'サービス',         'href' => $is_home ? '#service' : '/#service',   'slug' => ''),
        array('label' => '庭づくりのこだわり', 'href' => $is_home ? '#reason'  : '/#reason',    'slug' => ''),
        array('label' => 'お客様の声',        'href' => $is_home ? '#voice'   : '/#voice',     'slug' => ''),
        array('label' => 'ニュース',          'href' => $is_home ? '#news'    : '/news/',      'slug' => 'news'),
        array('label' => 'よくあるご質問',     'href' => $is_home ? '#faq'     : '/faq/',       'slug' => 'faq'),
        array('label' => '会社概要',          'href' => '/company/',                           'slug' => 'company'),
    );
}

/** 施工事例一覧（WordPress版から移植・静的。将来は works API へ差し替え） */
function ukai_works_items() {
	return array(
		array(
			'img'   => 'genExterior1',
			'taste' => 'modern',
			'cat'   => 'new-exterior concrete',
			'tags'  => array( '新築外構', '土間コンクリート' ),
			'title' => '駐車場まで整えた新築外構一式',
			'desc'  => '門まわりから駐車場、境界フェンスまで一体で計画し、暮らし始めやすい外構に仕上げました。',
			'loc'   => '愛知県一宮市',
		),
		array(
			'img'   => 'worksNavy',
			'taste' => 'modern',
			'cat'   => 'new-exterior fence',
			'tags'  => array( '新築外構', 'フェンス' ),
			'title' => 'シンプルモダンな新築外構',
			'desc'  => '建物の外観に合わせ、直線的なデザインと植栽で落ち着いた印象にまとめました。',
			'loc'   => '愛知県豊田市',
		),
		array(
			'img'   => 'heroMain',
			'taste' => 'japanese',
			'cat'   => 'new-exterior approach',
			'tags'  => array( '新築外構', 'アプローチ' ),
			'title' => '建物外観になじむ新築外構',
			'desc'  => '玄関アプローチと植栽を丁寧に整え、住まいの第一印象を高めました。',
			'loc'   => '愛知県津島市',
		),
		array(
			'img'   => 'genCarport1',
			'taste' => 'modern',
			'cat'   => 'carport concrete',
			'tags'  => array( 'カーポート', '土間コンクリート' ),
			'title' => '2台用カーポートと駐車場仕上げ',
			'desc'  => '雨の日の乗り降りや車の出入りを考え、カーポートと土間をまとめて施工しました。',
			'loc'   => '愛知県稲沢市',
		),
		array(
			'img'   => 'materialExterior',
			'taste' => 'modern',
			'cat'   => 'carport concrete',
			'tags'  => array( 'カーポート', '駐車場' ),
			'title' => '片流れカーポートの駐車スペース',
			'desc'  => '限られた敷地でも使いやすいよう、柱位置と土間勾配を調整しました。',
			'loc'   => '愛知県小牧市',
		),
		array(
			'img'   => 'genConcrete2',
			'taste' => 'modern',
			'cat'   => 'carport concrete',
			'tags'  => array( 'カーポート', '土間コンクリート' ),
			'title' => '駐車しやすいカーポート外構',
			'desc'  => '車の切り返しや歩行動線を確認し、日常で使いやすい駐車場に整えました。',
			'loc'   => '愛知県春日井市',
		),
		array(
			'img'   => 'genFence1',
			'taste' => 'modern',
			'cat'   => 'fence',
			'tags'  => array( 'フェンス', '目隠し' ),
			'title' => '視線を抑える目隠しフェンス',
			'desc'  => '道路や隣地からの視線をやわらげ、外観になじむ色味で施工しました。',
			'loc'   => '愛知県北名古屋市',
		),
		array(
			'img'   => 'worksBlackFence',
			'taste' => 'modern',
			'cat'   => 'fence garden',
			'tags'  => array( 'フェンス', '植栽' ),
			'title' => '黒フェンスで引き締める外構',
			'desc'  => '植栽が映えるように、すっきりとしたフェンスで境界を整えました。',
			'loc'   => '愛知県安城市',
		),
		array(
			'img'   => 'workPng1',
			'taste' => 'garden',
			'cat'   => 'fence garden',
			'tags'  => array( 'フェンス', '庭まわり' ),
			'title' => '庭を囲うプライベートフェンス',
			'desc'  => '圧迫感を抑えながら、家族が過ごしやすい庭空間をつくりました。',
			'loc'   => '愛知県岩倉市',
		),
		array(
			'img'   => 'genTurf1',
			'taste' => 'garden',
			'cat'   => 'turf garden',
			'tags'  => array( '人工芝', '庭づくり' ),
			'title' => '人工芝のプライベートガーデン',
			'desc'  => '手入れしやすい人工芝とステップを組み合わせ、使いやすい庭にしました。',
			'loc'   => '愛知県岡崎市',
		),
		array(
			'img'   => 'voiceFamily',
			'taste' => 'garden',
			'cat'   => 'turf garden',
			'tags'  => array( '人工芝', '雑草対策' ),
			'title' => '雑草対策を兼ねた人工芝施工',
			'desc'  => '防草シートと人工芝で、見た目と管理のしやすさを両立しました。',
			'loc'   => '愛知県春日井市',
		),
		array(
			'img'   => 'naturalGarden',
			'taste' => 'garden',
			'cat'   => 'turf fence garden',
			'tags'  => array( '人工芝', 'フェンス' ),
			'title' => '人工芝とフェンスの庭リフォーム',
			'desc'  => 'お子様やご家族が過ごしやすいよう、芝スペースと目隠しを整えました。',
			'loc'   => '愛知県豊明市',
		),
		array(
			'img'   => 'genConcrete1',
			'taste' => 'modern',
			'cat'   => 'concrete',
			'tags'  => array( '土間コンクリート', '駐車場' ),
			'title' => '使いやすい土間コンクリート駐車場',
			'desc'  => '勾配や排水を確認しながら、車の乗り入れがしやすい駐車場に仕上げました。',
			'loc'   => '愛知県名古屋市',
		),
		array(
			'img'   => 'voiceBudget',
			'taste' => 'modern',
			'cat'   => 'concrete new-exterior',
			'tags'  => array( '土間コンクリート', '新築外構' ),
			'title' => '門まわりと土間のシンプル外構',
			'desc'  => '白い門柱と土間コンクリートで、清潔感のある外まわりに整えました。',
			'loc'   => '愛知県小牧市',
		),
		array(
			'img'   => 'naturalApproach',
			'taste' => 'natural',
			'cat'   => 'concrete approach',
			'tags'  => array( '土間コンクリート', 'アプローチ' ),
			'title' => '石張りアプローチと駐車スペース',
			'desc'  => '玄関までの印象を高めながら、毎日の駐車もしやすく仕上げました。',
			'loc'   => '愛知県刈谷市',
		),
		array(
			'img'   => 'genBlock1',
			'taste' => 'modern',
			'cat'   => 'block fence',
			'tags'  => array( 'ブロック積み', 'フェンス' ),
			'title' => '境界ブロック積みとフェンス設置',
			'desc'  => '敷地境界を明確にし、安全性と見た目のバランスを考えて施工しました。',
			'loc'   => '愛知県江南市',
		),
		array(
			'img'   => 'worksWa',
			'taste' => 'japanese',
			'cat'   => 'block new-exterior',
			'tags'  => array( 'ブロック積み', '門まわり' ),
			'title' => '門柱まわりのブロック工事',
			'desc'  => '落ち着いた門まわりに合わせ、ブロックと植栽で外観を整えました。',
			'loc'   => '愛知県西尾市',
		),
		array(
			'img'   => 'materialPlanter',
			'taste' => 'garden',
			'cat'   => 'block garden',
			'tags'  => array( 'ブロック積み', '花壇' ),
			'title' => 'ブロック花壇の庭まわり施工',
			'desc'  => '境界をきれいに整えながら、植栽スペースとして使える花壇を施工しました。',
			'loc'   => '愛知県犬山市',
		),
		array(
			'img'   => 'genCivil1',
			'taste' => 'civil',
			'cat'   => 'civil',
			'tags'  => array( '造成工事', '整地' ),
			'title' => '建築前の造成・整地工事',
			'desc'  => '建築計画に合わせて敷地を整え、次工程へ進めやすい状態に仕上げました。',
			'loc'   => '愛知県一宮市',
		),
		array(
			'img'   => 'genCivil2',
			'taste' => 'civil',
			'cat'   => 'civil block',
			'tags'  => array( '造成工事', '擁壁' ),
			'title' => '高低差を整える造成・擁壁工事',
			'desc'  => '敷地の高さや排水を確認し、安全に使える土地へ整備しました。',
			'loc'   => '愛知県大府市',
		),
		array(
			'img'   => 'genCivil3',
			'taste' => 'civil',
			'cat'   => 'civil',
			'tags'  => array( '造成工事', '土木工事' ),
			'title' => '宅地造成と排水計画の整備',
			'desc'  => '雨水の流れや敷地の使い方を考慮し、建築前の土地を扱いやすく整えました。',
			'loc'   => '愛知県清須市',
		),
	);
}

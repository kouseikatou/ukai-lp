<?php
/**
 * WordPress 互換シム（スタンドアロン版）。
 * 既存テンプレートが使う最小限の WP 関数と、microCMS バックエンドの投稿ループを提供する。
 */

/* ---------- エスケープ ---------- */
function esc_html($s)  { return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8'); }
function esc_attr($s)  { return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8'); }
function esc_url($s)   { return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8'); }
function esc_html_e($s){ echo esc_html($s); }

/* ---------- サイト情報 / URL ---------- */
function language_attributes() { echo 'lang="ja"'; }
function bloginfo($key) {
    if ($key === 'charset') echo 'UTF-8';
    elseif ($key === 'name') echo '鵜飼工業';
}
function get_bloginfo($key = '') { return $key === 'name' ? '鵜飼工業' : ''; }
function body_class($extra = '') {
    $slug = $GLOBALS['UKAI_PAGE'] ?? '';
    echo 'class="' . esc_attr(trim('page-' . $slug . ' ' . $extra)) . '"';
}
function home_url($path = '') {
    $p = '/' . ltrim((string) $path, '/');
    return $p;
}
function trailingslashit($s) { return rtrim((string) $s, '/') . '/'; }
function add_query_arg($k, $v, $url) {
    $sep = strpos($url, '?') !== false ? '&' : '?';
    return $url . $sep . rawurlencode($k) . '=' . rawurlencode($v);
}
function get_template_directory_uri() { return ''; }
function get_template_directory()     { return dirname(__DIR__); }

/* ---------- 条件分岐 ---------- */
function is_front_page() { return ($GLOBALS['UKAI_PAGE'] ?? '') === 'home'; }
function is_home()       { return false; }
function is_page($s = '') {
    $cur = $GLOBALS['UKAI_PAGE'] ?? '';
    if ($s === '') return in_array($cur, array('home', 'works', 'faq', 'company', 'contact', 'news'), true);
    return $cur === $s;
}
function is_singular($t = '') { return ($GLOBALS['UKAI_PAGE'] ?? '') === 'news-detail'; }

/* ---------- ヘッダー / フッター ---------- */
function get_header() { require __DIR__ . '/header.php'; }
function get_footer() { require __DIR__ . '/footer.php'; }
function wp_head()    { ukai_print_title(); ukai_print_styles(); }
function wp_footer()  { ukai_print_scripts(); }

/** ページ別 <title> と meta description を出力（旧 title-tag 機能の代替） */
function ukai_print_title() {
    $site = '鵜飼工業';
    $page = $GLOBALS['UKAI_PAGE'] ?? '';
    $map  = array(
        'home'    => array('外構・お庭づくり',  '愛知県の外構・エクステリア・お庭づくりは鵜飼工業へ。新築外構からリフォーム、造成工事まで対応します。'),
        'works'   => array('施工事例',          '鵜飼工業の外構・お庭づくりの施工事例をご紹介します。'),
        'faq'     => array('よくあるご質問',    '外構工事・お庭づくりに関するよくあるご質問にお答えします。'),
        'company' => array('会社概要',          '鵜飼工業の会社概要をご紹介します。'),
        'contact' => array('お問い合わせ',      '外構・お庭づくりのご相談・お見積もりは無料です。お気軽にお問い合わせください。'),
        'news'    => array('ニュース・お知らせ', '鵜飼工業からの最新のお知らせ・施工事例・イベント情報をお届けします。'),
    );
    if ($page === 'news-detail') {
        $q     = $GLOBALS['ukai_main_query'] ?? null;
        $title = ($q && !empty($q->posts[0]['title'])) ? $q->posts[0]['title'] : 'お知らせ';
        $desc  = ($q && !empty($q->posts[0]['body']))
            ? mb_substr(trim(preg_replace('/\s+/', ' ', strip_tags($q->posts[0]['body']))), 0, 110)
            : '';
        $full  = $title . '｜' . $site;
    } elseif (isset($map[$page])) {
        $full = ($page === 'home') ? ($site . '｜' . $map[$page][0]) : ($map[$page][0] . '｜' . $site);
        $desc = $map[$page][1];
    } else {
        $full = $site;
        $desc = '';
    }
    echo '<title>' . esc_html($full) . '</title>' . "\n";
    if ($desc !== '') echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
}

function ukai_asset_ver($rel) {
    $f = dirname(__DIR__) . $rel;
    return is_file($f) ? ('?v=' . filemtime($f)) : '';
}
function ukai_print_styles() {
    $page = $GLOBALS['UKAI_PAGE'] ?? '';
    echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;600;700&family=Noto+Serif+JP:wght@400;500;600;700&family=Cormorant+Garamond:wght@300;400;500;600&family=Lora:wght@400;500;600&display=swap">' . "\n";
    $styles = array('/css/styles.css');
    if ($page !== 'home')        $styles[] = '/css/works.css';
    if ($page === 'company')     $styles[] = '/css/company.css';
    if ($page === 'contact')     $styles[] = '/css/contact.css';
    if ($page === 'faq')         $styles[] = '/css/faq.css';
    if ($page === 'news')        $styles[] = '/css/news.css';
    if ($page === 'news-detail') { $styles[] = '/css/news.css'; $styles[] = '/css/news-detail.css'; }
    if ($page === 'works')       $styles[] = '/css/works-cta.css';
    $styles[] = '/css/menu.css';
    $styles[] = '/css/animations.css';
    foreach ($styles as $s) {
        echo '<link rel="stylesheet" href="' . $s . ukai_asset_ver($s) . '">' . "\n";
    }
}
function ukai_print_scripts() {
    $page = $GLOBALS['UKAI_PAGE'] ?? '';
    echo '<script>window.UKAI = { theme: "", assets: "/assets", home: "/" };</script>' . "\n";
    $scripts = array('/js/script.js', '/js/menu.js', '/js/animations.js');
    if ($page === 'contact') $scripts[] = '/js/contact.js';
    if ($page === 'news')    $scripts[] = '/js/news.js';
    if ($page === 'works')   $scripts[] = '/js/works.js';
    foreach ($scripts as $s) {
        echo '<script src="' . $s . ukai_asset_ver($s) . '"></script>' . "\n";
    }
}

/* ---------- 投稿ループ（microCMS news バックエンド） ---------- */
function ukai_normalize_news($c) {
    return array(
        'ID'       => $c['id'] ?? '',
        'title'    => $c['title'] ?? '',
        'body'     => $c['body'] ?? '',
        'date'     => $c['publishedAt'] ?? ($c['createdAt'] ?? ''),
        'eyecatch' => isset($c['eyecatch']['url']) ? $c['eyecatch']['url'] : '',
    );
}

class WP_Query {
    public $posts   = array();
    public $current = -1;
    public function __construct($args = array()) {
        $this->posts = ukai_run_news_query($args);
    }
    public function have_posts() { return ($this->current + 1) < count($this->posts); }
    public function the_post() {
        $this->current++;
        $GLOBALS['ukai_post'] = $this->posts[$this->current];
    }
}

function ukai_run_news_query($args) {
    $ppp = $args['posts_per_page'] ?? 10;
    $not = $args['post__not_in'] ?? array();
    if ($ppp == -1) {
        $list = ukai_news_all();
    } else {
        $d    = ukai_news_list(array('limit' => (int) $ppp + count($not), 'orders' => '-publishedAt'));
        $list = $d['contents'] ?? array();
    }
    $out = array();
    foreach ($list as $c) {
        if (in_array($c['id'] ?? '', $not, true)) continue;
        $out[] = ukai_normalize_news($c);
    }
    if ($ppp != -1) $out = array_slice($out, 0, (int) $ppp);
    return $out;
}

/* グローバルループ（メインクエリ = $GLOBALS['ukai_main_query']） */
function have_posts() { $q = $GLOBALS['ukai_main_query'] ?? null; return $q ? $q->have_posts() : false; }
function the_post()   { $q = $GLOBALS['ukai_main_query'] ?? null; if ($q) $q->the_post(); }
function wp_reset_postdata() {
    $q = $GLOBALS['ukai_main_query'] ?? null;
    if ($q && isset($q->posts[$q->current])) $GLOBALS['ukai_post'] = $q->posts[$q->current];
}

function ukai_cur() { return $GLOBALS['ukai_post'] ?? null; }

function ukai_news_index() {
    static $idx = null;
    if ($idx === null) {
        $idx = array();
        foreach (ukai_news_all() as $c) { $idx[$c['id']] = $c; }
    }
    return $idx;
}

function get_the_ID() { $p = ukai_cur(); return $p['ID'] ?? 0; }
function the_title()  { echo esc_html(get_the_title()); }
function get_the_title($id = 0) {
    if ($id) { $i = ukai_news_index(); return $i[$id]['title'] ?? ''; }
    $p = ukai_cur(); return $p['title'] ?? '';
}
function the_title_attribute() { echo esc_attr(get_the_title()); }
function the_content()         { $p = ukai_cur(); echo $p['body'] ?? ''; }
function get_the_excerpt()     { $p = ukai_cur(); return trim(preg_replace('/\s+/', ' ', strip_tags($p['body'] ?? ''))); }

function ukai_fmt_date($iso, $fmt = 'Y.m.d') {
    if (!$iso) return '';
    try {
        $dt = new DateTime($iso);
        $dt->setTimezone(new DateTimeZone('Asia/Tokyo'));
        return $dt->format($fmt);
    } catch (Exception $e) { return ''; }
}
function get_the_date($fmt = 'Y.m.d', $id = 0) {
    if ($id) { $i = ukai_news_index(); return ukai_fmt_date($i[$id]['publishedAt'] ?? '', $fmt); }
    $p = ukai_cur(); return ukai_fmt_date($p['date'] ?? '', $fmt);
}
function get_permalink($id = 0) {
    if (is_object($id)) $id = $id->ID;
    if (!$id) { $p = ukai_cur(); $id = $p['ID'] ?? ''; }
    return '/news/' . $id . '/';
}
function has_post_thumbnail()                      { $p = ukai_cur(); return !empty($p['eyecatch']); }
function get_the_post_thumbnail_url($id = 0, $s = '') { $p = ukai_cur(); return $p['eyecatch'] ?? ''; }

function ukai_adjacent($dir) {
    $all   = array_values(ukai_news_all()); // publishedAt 降順
    $curId = get_the_ID();
    foreach ($all as $i => $c) {
        if (($c['id'] ?? '') === $curId) {
            $j = $i + $dir;
            if ($j >= 0 && $j < count($all)) {
                $o = new stdClass();
                $o->ID = $all[$j]['id'];
                return $o;
            }
            return null;
        }
    }
    return null;
}
function get_previous_post() { return ukai_adjacent(+1); } // 1つ古い記事
function get_next_post()     { return ukai_adjacent(-1); } // 1つ新しい記事

function wp_trim_words($text, $num = 55, $more = '…') {
    $text = trim(preg_replace('/\s+/', ' ', strip_tags((string) $text)));
    if ($text === '') return '';
    if (mb_strlen($text) <= $num) return $text;
    return mb_substr($text, 0, $num) . $more;
}

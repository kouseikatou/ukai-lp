<?php
$GLOBALS['UKAI_PAGE'] = 'news-detail';
require __DIR__ . '/inc/bootstrap.php';

$id   = isset($_GET['id']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['id']) : '';
$post = $id ? ukai_news_detail($id) : null;

if (!$post || empty($post['id'])) {
    http_response_code(404);
    $GLOBALS['ukai_main_query'] = new WP_Query(array('posts_per_page' => 0));
    echo '<!doctype html><html lang="ja"><meta charset="UTF-8"><title>記事が見つかりません</title>';
    echo '<body style="font-family:sans-serif;padding:80px;text-align:center"><h1>404</h1><p>記事が見つかりませんでした。</p><p><a href="/news/">ニュース一覧へ戻る</a></p></body></html>';
    return;
}

// メインクエリにこの記事1件をセット → single テンプレの have_posts/the_post が回る
$q = new WP_Query(array('posts_per_page' => 0));
$q->posts = array(ukai_normalize_news($post));
$GLOBALS['ukai_main_query'] = $q;

require __DIR__ . '/templates/news-detail.php';

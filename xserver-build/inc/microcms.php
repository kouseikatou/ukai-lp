<?php
/**
 * microCMS HTTP クライアント（ファイルキャッシュ付き）
 */
function ukai_cfg($key = null) {
    static $cfg = null;
    if ($cfg === null) {
        $path = __DIR__ . '/config.php';
        $cfg  = is_file($path) ? require $path : require __DIR__ . '/config.sample.php';
    }
    return $key === null ? $cfg : ($cfg[$key] ?? null);
}

function ukai_cache_dir() { return dirname(__DIR__) . '/cache'; }

function ukai_cache_get($key) {
    $ttl = (int) ukai_cfg('cache_ttl');
    if ($ttl <= 0) return null;
    $f = ukai_cache_dir() . '/' . md5($key) . '.json';
    if (is_file($f) && (time() - filemtime($f) < $ttl)) {
        $d = file_get_contents($f);
        return $d === false ? null : json_decode($d, true);
    }
    return null;
}

function ukai_cache_set($key, $data) {
    $ttl = (int) ukai_cfg('cache_ttl');
    if ($ttl <= 0) return;
    $dir = ukai_cache_dir();
    if (!is_dir($dir)) @mkdir($dir, 0775, true);
    @file_put_contents($dir . '/' . md5($key) . '.json', json_encode($data));
}

/** microCMS API へ GET。失敗時は null。 */
function ukai_mcms_request($endpoint, $params = array()) {
    $cacheKey = $endpoint . '?' . http_build_query($params);
    $cached   = ukai_cache_get($cacheKey);
    if ($cached !== null) return $cached;

    $url = 'https://' . ukai_cfg('service_id') . '.microcms.io/api/v1/' . $endpoint;
    if ($params) $url .= '?' . http_build_query($params);

    $ch = curl_init($url);
    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => array('X-MICROCMS-API-KEY: ' . ukai_cfg('api_key')),
        CURLOPT_TIMEOUT        => 10,
    ));
    $res  = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($res === false || $code >= 400) return null;
    $data = json_decode($res, true);
    if ($data === null) return null;

    ukai_cache_set($cacheKey, $data);
    return $data;
}

/** news 一覧取得（{contents,totalCount,...} or null） */
function ukai_news_list($params = array()) {
    return ukai_mcms_request('news', $params);
}

/** news 詳細取得（id 指定） */
function ukai_news_detail($id) {
    return ukai_mcms_request('news/' . rawurlencode($id));
}

/** news 全件（id,title,publishedAt,eyecatch のみ）。年別一覧/前後記事用。 */
function ukai_news_all() {
    static $all = null;
    if ($all !== null) return $all;
    $all   = array();
    $limit = 100;
    $offset = 0;
    $total = null;
    do {
        $d = ukai_news_list(array(
            'limit'  => $limit,
            'offset' => $offset,
            'orders' => '-publishedAt',
            'fields' => 'id,title,publishedAt,eyecatch',
        ));
        if (!$d || empty($d['contents'])) break;
        $all   = array_merge($all, $d['contents']);
        $total = $d['totalCount'] ?? count($all);
        $offset += $limit;
    } while ($offset < ($total ?? 0) && $offset < 1000);
    return $all;
}

/**
 * works/faq/voice などのコレクション。
 * microCMS に該当 API があればそれを、無ければ同梱 JSON をフォールバック利用。
 */
function ukai_collection($endpoint) {
    $d = ukai_mcms_request($endpoint, array('limit' => 100));
    if ($d && !empty($d['contents'])) return $d['contents'];
    $f = dirname(__DIR__) . '/data/' . $endpoint . '.json';
    if (is_file($f)) {
        $j = json_decode(file_get_contents($f), true);
        if (is_array($j)) return $j;
    }
    return array();
}

<?php
/**
 * microCMS 接続設定（テンプレート）
 * 本番では config.php にコピーし、実値を設定する。config.php は .gitignore 済み。
 */
return array(
    // microCMS のサービスID（ https://{ここ}.microcms.io ）
    'service_id' => 'YOUR_SERVICE_ID',
    // microCMS の API キー（X-MICROCMS-API-KEY）
    'api_key'    => 'YOUR_API_KEY',
    // APIキャッシュの有効秒数（0でキャッシュ無効）
    'cache_ttl'  => 600,
    // サイトのベースURL（OGP等で使用）
    'site_url'   => 'https://ukai-kogyo.jp',
);

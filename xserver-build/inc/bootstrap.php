<?php
/** 共通ブートストラップ：設定・microCMSクライアント・WP互換シム・表示ヘルパーを読み込む */
mb_internal_encoding('UTF-8');
require __DIR__ . '/microcms.php';
require __DIR__ . '/functions-lite.php';
require __DIR__ . '/wp-shim.php';

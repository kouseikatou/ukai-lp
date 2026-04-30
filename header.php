<?php
/**
 * 共通ヘッダー
 *
 * @package UkaiKogyo
 */

$ukai_current = ukai_current_page_slug();
$ukai_items   = ukai_nav_items();
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- ============ HEADER ============ -->
<header class="site-header" id="site-header">
  <div class="header-inner">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
      <span class="logo-mark" aria-hidden="true">
        <svg viewBox="0 0 40 40" width="34" height="34"><path d="M6 30 L20 8 L34 30 L27 30 L20 18 L13 30 Z" fill="none" stroke="currentColor" stroke-width="1.4"/><path d="M12 30 L20 16 L28 30" fill="none" stroke="currentColor" stroke-width="1.4"/></svg>
      </span>
      <span class="logo-text">
        <span class="logo-ja">鵜飼工業</span>
        <span class="logo-en">UKAI KOGYO</span>
      </span>
    </a>
    <nav class="nav">
      <?php foreach ( $ukai_items as $item ) :
        $is_active = ! empty( $item['slug'] ) && $item['slug'] === $ukai_current;
      ?>
      <a href="<?php echo esc_url( $item['href'] ); ?>"<?php echo $is_active ? ' class="active"' : ''; ?>><?php echo esc_html( $item['label'] ); ?></a>
      <?php endforeach; ?>
    </nav>
    <div class="header-cta">
      <a href="<?php echo esc_url( ukai_contact_url() ); ?>"<?php echo ukai_contact_link_attrs(); ?> class="btn-contact<?php echo 'contact' === $ukai_current ? ' active' : ''; ?>">
        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 6h18v12H3z"/><path d="M3 6l9 7 9-7"/></svg>
        ご相談・お問い合わせ
      </a>
      <button class="hamburger" aria-label="menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>

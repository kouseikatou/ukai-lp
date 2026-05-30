<?php
/**
 * 共通フッター
 *
 * @package UkaiKogyo
 */

$ukai_items = ukai_nav_items();
$ukai_logo  = get_template_directory_uri() . '/assets/logo.png';
?>

<!-- ============ FOOTER ============ -->
<footer class="footer" id="company">
  <div class="footer-inner">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo logo-footer">
      <img src="<?php echo esc_url( $ukai_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo-image logo-image-footer" width="58" height="60">
    </a>
    <nav class="footer-nav">
      <?php foreach ( $ukai_items as $item ) : ?>
      <a href="<?php echo esc_url( $item['href'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
      <?php endforeach; ?>
    </nav>
    <nav class="footer-sub">
      <a href="#">プライバシーポリシー</a>
      <a href="#">サイトマップ</a>
    </nav>
  </div>
  <div class="footer-copy">© UKAI KOGYO All Rights Reserved.</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

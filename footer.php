<?php
/**
 * 共通フッター
 *
 * @package UkaiKogyo
 */

$ukai_items = ukai_nav_items();
?>

<!-- ============ FOOTER ============ -->
<footer class="footer" id="company">
  <div class="footer-inner">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo logo-footer">
      <span class="logo-mark" aria-hidden="true">
        <svg viewBox="0 0 40 40" width="30" height="30"><path d="M6 30 L20 8 L34 30 L27 30 L20 18 L13 30 Z" fill="none" stroke="currentColor" stroke-width="1.4"/><path d="M12 30 L20 16 L28 30" fill="none" stroke="currentColor" stroke-width="1.4"/></svg>
      </span>
      <span class="logo-text">
        <span class="logo-ja">鵜飼工業</span>
        <span class="logo-en">UKAI KOGYO</span>
      </span>
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

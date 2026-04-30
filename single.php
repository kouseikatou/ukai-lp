<?php
/**
 * 投稿詳細（ニュース記事）テンプレート
 *
 * @package UkaiKogyo
 */
get_header();

while ( have_posts() ) :
	the_post();
	$cat       = ukai_post_news_category( get_the_ID() );
	$cat_slug  = $cat ? $cat->slug : 'info';
	$cat_name  = $cat ? $cat->name : 'お知らせ';
	$tag_class = ukai_news_tag_class( $cat_slug );
	$hero_url  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : '';

	$prev_post = get_previous_post();
	$next_post = get_next_post();

	$related = new WP_Query(
		array(
			'post_type'           => 'post',
			'posts_per_page'      => 3,
			'post_status'         => 'publish',
			'post__not_in'        => array( get_the_ID() ),
			'category__in'        => $cat ? array( $cat->term_id ) : array(),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
?>

<!-- HEADER -->
<header class="site-header">
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
      <a href="/works/">施工事例</a>
      <a href="/#service">サービス</a>
      <a href="/#reason">庭づくりのこだわり</a>
      <a href="/#voice">お客様の声</a>
      <a href="/news/" class="active">ニュース</a>
      <a href="/#faq">よくあるご質問</a>
      <a href="/company/">会社概要</a>
    </nav>
    <div class="header-cta">
      <a href="/contact/" class="btn-contact">
        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 6h18v12H3z"/><path d="M3 6l9 7 9-7"/></svg>
        ご相談・お問い合わせ
      </a>
      <button class="hamburger" aria-label="menu"><span></span><span></span><span></span></button>
    </div>
  </div>
</header>

<!-- ARTICLE -->
<article class="news-article">
  <nav class="article-breadcrumbs" aria-label="パンくず">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a>
    <span class="sep">›</span>
    <a href="/news/">ニュース・お知らせ</a>
    <span class="sep">›</span>
    <span><?php the_title(); ?></span>
  </nav>

  <header class="article-header">
    <div class="article-meta">
      <span class="article-date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></span>
      <span class="news-tag <?php echo esc_attr( $tag_class ); ?>"><?php echo esc_html( $cat_name ); ?></span>
    </div>
    <h1 class="article-title"><?php the_title(); ?></h1>
  </header>

  <?php if ( $hero_url ): ?>
  <div class="article-hero" style="background-image:url('<?php echo esc_url( $hero_url ); ?>')" role="img" aria-label="<?php the_title_attribute(); ?>"></div>
  <?php endif; ?>

  <div class="article-body">
    <?php the_content(); ?>
  </div>

  <div class="article-foot">
    <div class="share-line">
      <span>SHARE</span>
      <a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode( get_permalink() ); ?>&text=<?php echo rawurlencode( get_the_title() . ' ｜ 鵜飼工業' ); ?>" target="_blank" rel="noopener" aria-label="Xでシェア">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
      </a>
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener" aria-label="Facebookでシェア">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
      </a>
      <a href="https://social-plugins.line.me/lineit/share?url=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener" aria-label="LINEでシェア">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19.365 9.89c.50 0 .906.41.906.91s-.405.91-.906.91h-1.265v.806h1.265c.5 0 .906.41.906.91s-.405.91-.906.91h-2.171c-.5 0-.906-.41-.906-.91V8.84c0-.5.405-.91.906-.91h2.171c.5 0 .906.41.906.91s-.405.91-.906.91h-1.265v.142h1.265zm-3.273 3.446c0 .39-.252.736-.622.86-.094.03-.193.046-.293.046-.296 0-.572-.143-.74-.387l-2.225-3.034v2.515c0 .5-.405.91-.906.91s-.906-.41-.906-.91V8.84c0-.39.251-.736.62-.86.092-.03.19-.046.292-.046.295 0 .57.144.737.387l2.227 3.034V8.84c0-.5.405-.91.906-.91s.905.41.905.91v4.496h.005zM9.853 13.336c0 .5-.405.91-.906.91s-.906-.41-.906-.91V8.84c0-.5.405-.91.906-.91s.906.41.906.91v4.496zm-2.6.91H5.083c-.5 0-.906-.41-.906-.91V8.84c0-.5.405-.91.906-.91s.905.41.905.91v3.586h1.265c.5 0 .905.41.905.91s-.405.91-.905.91zM24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.39.082.923.258 1.058.59.122.301.08.766.04 1.08l-.164 1.02c-.045.301-.236 1.186 1.049.647 1.279-.54 6.875-4.063 9.378-6.957C23.107 14.332 24 12.435 24 10.314"/></svg>
      </a>
    </div>
    <a class="back-to-list" href="/news/">← ニュース一覧へ戻る</a>
  </div>
</article>

<!-- PREV / NEXT -->
<nav class="article-nav" aria-label="前後の記事">
  <?php if ( $prev_post ): ?>
    <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
      <span class="an-dir">‹ PREV</span>
      <span class="an-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
    </a>
  <?php else: ?>
    <a class="an-disabled" aria-disabled="true">
      <span class="an-dir">‹ PREV</span>
      <span class="an-title">前の記事はありません</span>
    </a>
  <?php endif; ?>
  <?php if ( $next_post ): ?>
    <a class="an-next" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
      <span class="an-dir">NEXT ›</span>
      <span class="an-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
    </a>
  <?php else: ?>
    <a class="an-next an-disabled" aria-disabled="true">
      <span class="an-dir">NEXT ›</span>
      <span class="an-title">次の記事はありません</span>
    </a>
  <?php endif; ?>
</nav>

<?php if ( $related->have_posts() ): ?>
<!-- RELATED -->
<section class="related-news">
  <h3>関連する記事</h3>
  <div class="related-grid">
    <?php while ( $related->have_posts() ): $related->the_post();
      $r_cat   = ukai_post_news_category( get_the_ID() );
      $r_slug  = $r_cat ? $r_cat->slug : 'info';
      $r_class = ukai_news_tag_class( $r_slug );
      $r_thumb = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium' ) : '';
    ?>
    <a class="related-card" href="<?php echo esc_url( get_permalink() ); ?>">
      <div class="related-thumb"<?php if ( $r_thumb ): ?> style="background-image:url('<?php echo esc_url( $r_thumb ); ?>')"<?php endif; ?>></div>
      <div class="related-body">
        <span class="news-tag <?php echo esc_attr( $r_class ); ?>"><?php echo esc_html( $r_cat ? $r_cat->name : 'お知らせ' ); ?></span>
        <span class="related-date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></span>
        <span class="related-title"><?php the_title(); ?></span>
      </div>
    </a>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>
<?php endif; ?>

<!-- CTA -->
<section class="section faq-contact" style="padding-bottom:84px">
  <div class="faq-contact-inner" style="grid-template-columns: 1fr">
    <aside class="contact-card" style="max-width: 880px; margin: 0 auto; width: 100%">
      <div class="contact-copy">
        <h3>外構・お庭のことなら、<br/>お気軽にご相談ください。</h3>
        <p>ご相談・お見積もりは無料です。<br/>イベント情報や最新の施工事例もぜひチェックしてください。</p>
        <a class="btn btn-primary" href="/contact/">無料相談・お問い合わせはこちら<span class="arr">→</span></a>
      </div>
      <div class="contact-illust" data-img="family"></div>
    </aside>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer">
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
      <a href="/works/">施工事例</a>
      <a href="/#service">サービス</a>
      <a href="/#reason">庭づくりのこだわり</a>
      <a href="/#voice">お客様の声</a>
      <a href="/news/">ニュース</a>
      <a href="/#faq">よくあるご質問</a>
      <a href="/company/">会社概要</a>
    </nav>
    <nav class="footer-sub">
      <a href="#">プライバシーポリシー</a>
      <a href="#">サイトマップ</a>
    </nav>
  </div>
  <div class="footer-copy">© UKAI KOGYO All Rights Reserved.</div>
</footer>

<?php endwhile; ?>

<?php get_footer(); ?>

<?php
/**
 * Template Name: ニュース
 *
 * @package UkaiKogyo
 */
get_header();

/* === データ取得: ニュースカテゴリ件数を集計 === */
$cats_meta = ukai_news_categories();
$counts    = array( 'all' => 0 );
foreach ( $cats_meta as $slug => $_ ) {
	$counts[ $slug ] = 0;
}

$all_posts_q = new WP_Query(
	array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	)
);

$posts_by_year = array();
if ( $all_posts_q->have_posts() ) {
	while ( $all_posts_q->have_posts() ) {
		$all_posts_q->the_post();
		$counts['all']++;
		$cat = ukai_post_news_category( get_the_ID() );
		$cat_slug = $cat ? $cat->slug : 'info';
		if ( isset( $counts[ $cat_slug ] ) ) {
			$counts[ $cat_slug ]++;
		}
		$year = get_the_date( 'Y' );
		if ( ! isset( $posts_by_year[ $year ] ) ) {
			$posts_by_year[ $year ] = array();
		}
		$posts_by_year[ $year ][] = array(
			'id'        => get_the_ID(),
			'title'     => get_the_title(),
			'date_dot'  => get_the_date( 'Y.m.d' ),
			'cat_slug'  => $cat_slug,
			'cat_name'  => $cat ? $cat->name : 'お知らせ',
			'tag_class' => ukai_news_tag_class( $cat_slug ),
			'excerpt'   => get_the_excerpt(),
			'permalink' => get_permalink(),
		);
	}
	wp_reset_postdata();
}

// 年降順
krsort( $posts_by_year );

/** 西暦 → 令和元号 */
function ukai_reiwa( $year ) {
	$y = (int) $year;
	if ( $y < 2019 ) { return ''; }
	$r = $y - 2018;
	return ( 1 === $r ) ? '令和元年' : '令和' . $r . '年';
}
?>

<!-- PAGE HEAD -->
<section class="page-head">
  <div class="page-head-inner">
    <div class="eyebrow">NEWS</div>
    <h1 class="page-title">ニュース・お知らせ</h1>
    <p class="page-lead">イベント情報、施工事例の更新、休業日のお知らせなど、<br/>鵜飼工業からの最新情報をお届けします。</p>
    <nav class="breadcrumbs">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a>
      <span>›</span>
      <span>ニュース・お知らせ</span>
    </nav>
  </div>
</section>

<!-- CATEGORY TABS -->
<section class="news-tabs-wrap">
  <div class="news-tabs-inner">
    <div class="news-tabs" data-filter="cat">
      <button class="news-tab active" data-value="all">
        <span class="nt-label">すべて</span>
        <span class="nt-count"><?php echo (int) $counts['all']; ?></span>
      </button>
      <?php foreach ( $cats_meta as $slug => $cfg ): ?>
      <button class="news-tab" data-value="<?php echo esc_attr( $slug ); ?>">
        <span class="nt-dot" style="background:var(--<?php echo esc_attr( $cfg['tag_class'] === 'tag-event' ? 'tag-event' : ( $cfg['tag_class'] === 'tag-works' ? 'tag-works' : 'tag-info' ) ); ?>)"></span>
        <span class="nt-label"><?php echo esc_html( $cfg['name'] ); ?></span>
        <span class="nt-count"><?php echo (int) ( $counts[ $slug ] ?? 0 ); ?></span>
      </button>
      <?php endforeach; ?>
    </div>
    <div class="news-search">
      <svg viewBox="0 0 20 20" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="9" cy="9" r="6"/><path d="M14 14l4 4"/></svg>
      <input type="search" placeholder="記事を検索" id="news-search-input">
    </div>
  </div>
</section>

<!-- NEWS LIST -->
<section class="news-archive">

<?php if ( empty( $posts_by_year ) ): ?>
  <div style="max-width:880px; margin: 40px auto 80px; padding: 60px 28px; text-align:center; color: var(--ink-3);">
    <p>まだ投稿がありません。<br>
    <small>WordPress 管理画面の「投稿 &gt; 新規追加」から記事を追加するか、「ツール &gt; ニュースのサンプル投入」からサンプルを投入できます。</small></p>
  </div>
<?php else: ?>

  <?php foreach ( $posts_by_year as $year => $items ): ?>
  <!-- YEAR <?php echo esc_html( $year ); ?> -->
  <div class="news-year">
    <div class="news-year-label">
      <span class="ny-en"><?php echo esc_html( $year ); ?></span>
      <?php $reiwa = ukai_reiwa( $year ); if ( $reiwa ): ?>
      <span class="ny-ja"><?php echo esc_html( $reiwa ); ?></span>
      <?php endif; ?>
    </div>
    <ul class="news-archive-list">
      <?php foreach ( $items as $p ): ?>
      <li class="na-item" data-cat="<?php echo esc_attr( $p['cat_slug'] ); ?>">
        <a href="<?php echo esc_url( $p['permalink'] ); ?>">
          <div class="na-meta">
            <span class="na-date"><?php echo esc_html( $p['date_dot'] ); ?></span>
            <span class="news-tag <?php echo esc_attr( $p['tag_class'] ); ?>"><?php echo esc_html( $p['cat_name'] ); ?></span>
          </div>
          <div class="na-title"><?php echo esc_html( $p['title'] ); ?></div>
          <p class="na-excerpt"><?php echo esc_html( wp_trim_words( $p['excerpt'], 60, '…' ) ); ?></p>
          <span class="na-arrow">→</span>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endforeach; ?>

<?php endif; ?>

</section>

<!-- CTA -->
<section class="section faq-contact" style="padding-bottom:84px">
  <div class="faq-contact-inner" style="grid-template-columns: 1fr">
    <aside class="contact-card" style="max-width: 880px; margin: 0 auto; width: 100%">
      <div class="contact-copy">
        <h3>外構・お庭のことなら、<br/>お気軽にご相談ください。</h3>
        <p>ご相談・お見積もりは無料です。<br/>イベント情報や最新の施工事例もぜひチェックしてください。</p>
        <a class="btn btn-primary" href="https://docs.google.com/forms/d/e/1FAIpQLScjo7hymKSQXotVILgv59LAVYHmarkRy0b6zLCGdoaRWXskug/viewform" target="_blank" rel="noopener noreferrer">無料相談・お問い合わせはこちら<span class="arr">→</span></a>
      </div>
      <div class="contact-illust" data-img="family"></div>
    </aside>
  </div>
</section>

<?php get_footer(); ?>

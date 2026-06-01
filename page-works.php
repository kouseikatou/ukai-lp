<?php
/**
 * Template Name: 施工事例
 *
 * @package UkaiKogyo
 */
get_header();
?>

<!-- PAGE HEAD -->
<section class="page-head">
  <div class="page-head-inner">
    <div class="eyebrow">WORKS</div>
    <h1 class="page-title">施工事例一覧</h1>
    <p class="page-lead">これまでに手がけた施工事例をご紹介します。<br/>テイスト・カテゴリーから理想の庭づくりのヒントを見つけてください。</p>
    <nav class="breadcrumbs">
      <a href="/">トップ</a>
      <span>›</span>
      <span>施工事例一覧</span>
    </nav>
  </div>
</section>

<!-- FILTERS -->
<section class="filters">
  <div class="filters-inner">
    <div class="filter-group">
      <div class="filter-label">テイスト</div>
      <div class="chips" data-filter="taste">
        <button class="chip active" data-value="all">すべて</button>
        <button class="chip" data-value="modern">シンプルモダン</button>
        <button class="chip" data-value="natural">ナチュラル</button>
        <button class="chip" data-value="japanese">和モダン</button>
        <button class="chip" data-value="garden">ガーデン</button>
        <button class="chip" data-value="civil">造成・土木</button>
      </div>
    </div>
    <div class="filter-group">
      <div class="filter-label">カテゴリー</div>
      <div class="chips" data-filter="cat">
        <button class="chip active" data-value="all">すべて</button>
        <button class="chip" data-value="new-exterior">新築外構</button>
        <button class="chip" data-value="carport">カーポート</button>
        <button class="chip" data-value="fence">フェンス</button>
        <button class="chip" data-value="turf">人工芝</button>
        <button class="chip" data-value="concrete">土間コンクリート</button>
        <button class="chip" data-value="block">ブロック積み</button>
        <button class="chip" data-value="civil">造成工事</button>
        <button class="chip" data-value="approach">アプローチ</button>
        <button class="chip" data-value="garden">庭・植栽</button>
      </div>
    </div>
  </div>
  <div class="filter-result-row">
    <div class="filter-result"><span id="result-count"><?php echo esc_html( count( ukai_works_items() ) ); ?></span>件の施工事例</div>
    <select class="sort-select">
      <option>新着順</option>
    </select>
  </div>
</section>

<!-- WORKS GRID -->
<section class="works-archive">
  <div class="works-archive-grid">
    <?php foreach ( ukai_works_items() as $work ) : ?>
    <article class="wa-card" data-taste="<?php echo esc_attr( $work['taste'] ); ?>" data-cat="<?php echo esc_attr( $work['cat'] ); ?>">
      <div class="wa-img" data-img="<?php echo esc_attr( $work['img'] ); ?>"></div>
      <div class="wa-body">
        <div class="wa-tags">
          <?php foreach ( $work['tags'] as $tag ) : ?>
          <span><?php echo esc_html( $tag ); ?></span>
          <?php endforeach; ?>
        </div>
        <h3 class="wa-title"><?php echo esc_html( $work['title'] ); ?></h3>
        <p class="wa-desc"><?php echo esc_html( $work['desc'] ); ?></p>
      </div>
    </article>
    <?php endforeach; ?>

  </div>
</section>

<!-- CTA -->
<section class="works-cta-section">
  <div class="works-cta-inner">
    <div class="works-cta-eyebrow">CONTACT</div>
    <h2 class="works-cta-title">気になる事例があれば、<br/>お気軽にご相談ください。</h2>
    <p class="works-cta-lead">「この事例のような庭にしたい」「予算感を相談したい」など、<br class="hide-sp"/>具体的なイメージからのご相談も大歓迎です。</p>
    <a class="works-cta-btn" href="https://docs.google.com/forms/d/e/1FAIpQLScjo7hymKSQXotVILgv59LAVYHmarkRy0b6zLCGdoaRWXskug/viewform" target="_blank" rel="noopener noreferrer">
      <span>無料相談・お問い合わせはこちら</span>
      <span class="arr" aria-hidden="true">→</span>
    </a>
  </div>
</section>

<?php get_footer(); ?>

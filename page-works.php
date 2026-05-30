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
        <button class="chip" data-value="reno">リノベーション</button>
      </div>
    </div>
    <div class="filter-group">
      <div class="filter-label">カテゴリー</div>
      <div class="chips" data-filter="cat">
        <button class="chip active" data-value="all">すべて</button>
        <button class="chip" data-value="exterior">外構</button>
        <button class="chip" data-value="garden">庭・ガーデン</button>
        <button class="chip" data-value="approach">アプローチ</button>
        <button class="chip" data-value="fence">フェンス</button>
        <button class="chip" data-value="interior">リフォーム</button>
      </div>
    </div>
  </div>
  <div class="filter-result-row">
    <div class="filter-result"><span id="result-count">12</span>件の施工事例</div>
    <select class="sort-select">
      <option>新着順</option>
    </select>
  </div>
</section>

<!-- WORKS GRID -->
<section class="works-archive">
  <div class="works-archive-grid">

    <article class="wa-card" data-taste="garden" data-budget="b2" data-cat="garden fence">
      <div class="wa-img" data-img="work1"></div>
      <div class="wa-body">
        <div class="wa-tags"><span>ガーデン</span><span>フェンス</span></div>
        <h3 class="wa-title">ウッドフェンスのプライベートガーデン</h3>
        <div class="wa-meta">
          <span class="wa-loc">愛知県岡崎市</span>
        </div>
      </div>
    </article>

    <article class="wa-card" data-taste="modern" data-budget="b2" data-cat="exterior">
      <div class="wa-img" data-img="work2"></div>
      <div class="wa-body">
        <div class="wa-tags"><span>シンプルモダン</span><span>外構</span></div>
        <h3 class="wa-title">紺色サイディングの邸宅外構</h3>
        <div class="wa-meta">
          <span class="wa-loc">愛知県豊田市</span>
        </div>
      </div>
    </article>

    <article class="wa-card" data-taste="modern" data-budget="b2" data-cat="exterior fence">
      <div class="wa-img" data-img="work3"></div>
      <div class="wa-body">
        <div class="wa-tags"><span>シンプルモダン</span><span>外構</span></div>
        <h3 class="wa-title">黒フェンスが映えるモダン外構</h3>
        <div class="wa-meta">
          <span class="wa-loc">愛知県安城市</span>
        </div>
      </div>
    </article>

    <article class="wa-card" data-taste="natural" data-budget="b1" data-cat="approach">
      <div class="wa-img" data-img="work4"></div>
      <div class="wa-body">
        <div class="wa-tags"><span>ナチュラル</span><span>アプローチ</span></div>
        <h3 class="wa-title">ナチュラルテイストの玄関</h3>
        <div class="wa-meta">
          <span class="wa-loc">愛知県刈谷市</span>
        </div>
      </div>
    </article>

    <article class="wa-card" data-taste="natural" data-budget="b2" data-cat="approach">
      <div class="wa-img" data-img="work5"></div>
      <div class="wa-body">
        <div class="wa-tags"><span>ナチュラル</span><span>アプローチ</span></div>
        <h3 class="wa-title">石畳アプローチの白い玄関</h3>
        <div class="wa-meta">
          <span class="wa-loc">愛知県名古屋市</span>
        </div>
      </div>
    </article>

    <article class="wa-card" data-taste="japanese" data-budget="b1" data-cat="exterior">
      <div class="wa-img" data-img="work6"></div>
      <div class="wa-body">
        <div class="wa-tags"><span>和モダン</span><span>外構</span></div>
        <h3 class="wa-title">和モダン塗り壁の門周り</h3>
        <div class="wa-meta">
          <span class="wa-loc">愛知県西尾市</span>
        </div>
      </div>
    </article>

    <article class="wa-card" data-taste="modern" data-budget="b3" data-cat="exterior">
      <div class="wa-img" data-img="hero"></div>
      <div class="wa-body">
        <div class="wa-tags"><span>シンプルモダン</span><span>ライティング</span></div>
        <h3 class="wa-title">夕景に映えるライティング外構</h3>
        <div class="wa-meta">
          <span class="wa-loc">愛知県岡崎市</span>
        </div>
      </div>
    </article>

    <article class="wa-card" data-taste="reno" data-budget="b3" data-cat="interior">
      <div class="wa-img" data-img="ig1"></div>
      <div class="wa-body">
        <div class="wa-tags"><span>リノベーション</span><span>リフォーム</span></div>
        <h3 class="wa-title">木の温もりあふれるリビング</h3>
        <div class="wa-meta">
          <span class="wa-loc">愛知県豊田市</span>
        </div>
      </div>
    </article>

    <article class="wa-card" data-taste="reno" data-budget="b3" data-cat="interior">
      <div class="wa-img" data-img="ig2"></div>
      <div class="wa-body">
        <div class="wa-tags"><span>リノベーション</span><span>キッチン</span></div>
        <h3 class="wa-title">家族が集まる対面キッチン</h3>
        <div class="wa-meta">
          <span class="wa-loc">愛知県岡崎市</span>
        </div>
      </div>
    </article>

    <article class="wa-card" data-taste="reno" data-budget="b2" data-cat="interior">
      <div class="wa-img" data-img="ig3"></div>
      <div class="wa-body">
        <div class="wa-tags"><span>リノベーション</span><span>リビング</span></div>
        <h3 class="wa-title">ナチュラルな木目のダイニング</h3>
        <div class="wa-meta">
          <span class="wa-loc">愛知県安城市</span>
        </div>
      </div>
    </article>

    <article class="wa-card" data-taste="modern" data-budget="b2" data-cat="exterior">
      <div class="wa-img" data-img="worksConstruction"></div>
      <div class="wa-body">
        <div class="wa-tags"><span>外構工事</span><span>新築</span></div>
        <h3 class="wa-title">新築外構工事の様子</h3>
        <div class="wa-meta">
          <span class="wa-loc">愛知県知立市</span>
        </div>
      </div>
    </article>

    <article class="wa-card" data-taste="garden" data-budget="b1" data-cat="garden">
      <div class="wa-img" data-img="worksPlanting"></div>
      <div class="wa-body">
        <div class="wa-tags"><span>ガーデン</span><span>植栽</span></div>
        <h3 class="wa-title">四季を楽しむ植栽デザイン</h3>
        <div class="wa-meta">
          <span class="wa-loc">愛知県名古屋市</span>
        </div>
      </div>
    </article>

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

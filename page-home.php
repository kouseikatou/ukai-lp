<?php
/**
 * Template Name: ホーム
 *
 * @package UkaiKogyo
 */
get_header();

$ukai_assets      = get_template_directory_uri() . '/assets';
$ukai_hero_images = array(
  array(
    'file' => 'works-twilight-lighting.jpg',
    'pos'  => 'center 45%',
  ),
  array(
    'file' => 'natural-work-garden.jpg',
    'pos'  => 'center 50%',
  ),
  array(
    'file' => 'natural-work-entrance.jpg',
    'pos'  => 'center 48%',
  ),
  array(
    'file' => 'natural-work-approach.jpg',
    'pos'  => 'center 52%',
  ),
  array(
    'file' => 'works-navy-siding.jpg',
    'pos'  => 'center 50%',
  ),
);
?>

<!-- ============ HERO ============ -->
<section class="hero">
  <div class="hero-bg" id="hero-bg">
    <?php foreach ( $ukai_hero_images as $index => $image ) : ?>
      <div class="hero-slide<?php echo 0 === $index ? ' is-active' : ''; ?>" style="--hero-delay: <?php echo esc_attr( $index * 6 ); ?>s; --hero-position: <?php echo esc_attr( $image['pos'] ); ?>; background-image: linear-gradient(180deg, rgba(20,25,20,.08) 0%, rgba(20,25,20,.4) 100%), url('<?php echo esc_url( $ukai_assets . '/' . $image['file'] ); ?>');"></div>
    <?php endforeach; ?>
  </div>
  <div class="hero-inner">
    <div class="hero-text">
      <h1 class="hero-title">
        家族の毎日を、<br/>
        もっと心地よく、<br/>
        もっと好きな場所に。
      </h1>
      <p class="hero-sub">外構・エクステリア・庭づくりで、<br/>暮らしに寄り添う理想の住まいをカタチにします。</p>
      <div class="hero-ctas">
        <a class="btn btn-ghost" href="https://docs.google.com/forms/d/e/1FAIpQLScjo7hymKSQXotVILgv59LAVYHmarkRy0b6zLCGdoaRWXskug/viewform" target="_blank" rel="noopener noreferrer">無料相談・お問い合わせ<span class="arr">→</span></a>
        <a class="btn btn-ghost" href="#works">施工事例を見る<span class="arr">→</span></a>
      </div>
    </div>
  </div>
</section>

<!-- ============ WORKS ============ -->
<section class="section works" id="works">
  <div class="section-head">
    <div>
      <div class="eyebrow">WORKS</div>
      <h2 class="section-title">施工事例一覧</h2>
      <p class="section-lead">ナチュラル・モダン・シンプルなど、<br/>様々なテイストの施工事例をご紹介。</p>
      <a class="link-btn" href="/works/">すべての事例を見る<span class="arr">→</span></a>
    </div>
    <div class="works-grid">
      <figure class="work-card">
        <div class="work-img" data-img="work1"></div>
        <figcaption>
          <div class="wc-title">ウッドフェンスのプライベートガーデン</div>
        </figcaption>
      </figure>
      <figure class="work-card">
        <div class="work-img" data-img="work2"></div>
        <figcaption>
          <div class="wc-title">紺色サイディングの邸宅外構</div>
        </figcaption>
      </figure>
      <figure class="work-card">
        <div class="work-img" data-img="work3"></div>
        <figcaption>
          <div class="wc-title">シンプルモダンの外構</div>
        </figcaption>
      </figure>
      <figure class="work-card">
        <div class="work-img" data-img="work4"></div>
        <figcaption>
          <div class="wc-title">ナチュラルテイストの玄関</div>
        </figcaption>
      </figure>
      <figure class="work-card">
        <div class="work-img" data-img="work5"></div>
        <figcaption>
          <div class="wc-title">石畳アプローチの白い玄関</div>
        </figcaption>
      </figure>
      <figure class="work-card">
        <div class="work-img" data-img="work6"></div>
        <figcaption>
          <div class="wc-title">和モダン塗り壁の門周り</div>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="works-pager">
    <button aria-label="prev" class="pager-btn">‹</button>
    <button aria-label="next" class="pager-btn">›</button>
  </div>
</section>

<!-- ============ SERVICE ============ -->
<section class="section service" id="service">
  <div class="service-inner">
    <div class="service-head">
      <div class="eyebrow">SERVICE</div>
      <h2 class="section-title">サービス</h2>
      <p class="section-lead">外構・庭づくりに関することなら、<br/>トータルでサポートいたします。</p>
    </div>
    <div class="service-grid">
      <div class="svc-item">
        <div class="svc-icon">
          <svg viewBox="0 0 48 48" width="42" height="42" fill="none" stroke="currentColor" stroke-width="1.3">
            <path d="M8 40V18l16-10 16 10v22"/><path d="M8 40h32"/><path d="M18 40V28h12v12"/>
          </svg>
        </div>
        <div class="svc-title">外構工事</div>
        <div class="svc-desc">門柱からアプローチ・<br/>駐車場など外構全般の工事</div>
      </div>
      <div class="svc-item">
        <div class="svc-icon">
          <svg viewBox="0 0 48 48" width="42" height="42" fill="none" stroke="currentColor" stroke-width="1.3">
            <path d="M24 40V22"/><path d="M24 22c-6-4-10-2-14 2 4 6 10 6 14 2"/><path d="M24 22c6-4 10-2 14 2-4 6-10 6-14 2"/><path d="M24 18c-2-4 0-8 4-10 2 4 0 8-4 10"/>
          </svg>
        </div>
        <div class="svc-title">庭・ガーデン</div>
        <div class="svc-desc">植栽から芝生、ウッドデッキまで<br/>心地よい庭のデザイン</div>
      </div>
      <div class="svc-item">
        <div class="svc-icon">
          <svg viewBox="0 0 48 48" width="42" height="42" fill="none" stroke="currentColor" stroke-width="1.3">
            <path d="M10 14h28v24H10z"/><path d="M10 22h28"/><circle cx="16" cy="18" r="1.2" fill="currentColor" stroke="none"/><path d="M14 30l6-6 8 8"/>
          </svg>
        </div>
        <div class="svc-title">設計・デザイン</div>
        <div class="svc-desc">ご要望にあわせたプランを<br/>プロがご提案</div>
      </div>
      <div class="svc-item">
        <div class="svc-icon">
          <svg viewBox="0 0 48 48" width="42" height="42" fill="none" stroke="currentColor" stroke-width="1.3">
            <path d="M8 40V20l16-12 16 12v20"/><path d="M8 40h32"/><path d="M18 40V30h12v10"/><path d="M32 12l4-4 4 4-4 4z"/>
          </svg>
        </div>
        <div class="svc-title">リフォーム・リノベーション</div>
        <div class="svc-desc">使いやすく、暮らしに合った<br/>外構リフォーム</div>
      </div>
      <div class="svc-item">
        <div class="svc-icon">
          <svg viewBox="0 0 48 48" width="42" height="42" fill="none" stroke="currentColor" stroke-width="1.3">
            <path d="M24 40s-14-8-14-20a8 8 0 0 1 14-5 8 8 0 0 1 14 5c0 12-14 20-14 20z"/>
          </svg>
        </div>
        <div class="svc-title">アフターサポート</div>
        <div class="svc-desc">工事後も安心の<br/>メンテナンスサポート</div>
      </div>
    </div>
  </div>
</section>

<!-- ============ REASON ============ -->
<section class="section reason" id="reason">
  <div class="reason-inner">
    <div class="reason-head">
      <div class="eyebrow">REASON</div>
      <h2 class="section-title">鵜飼工業が選ばれる理由</h2>
    </div>
    <div class="reason-grid">
      <article class="reason-card">
        <div class="reason-img" data-img="reason1"><span class="num">1</span></div>
        <h3>丁寧なヒアリング</h3>
        <p>ご家族のご要望を丁寧にお伺いし、<br/>理想の暮らしをカタチに。</p>
      </article>
      <article class="reason-card">
        <div class="reason-img" data-img="reason2"><span class="num">2</span></div>
        <h3>ちょうどいい価格</h3>
        <p>中間マージンを省き、適正価格で<br/>高品質な工事をご提供。</p>
      </article>
      <article class="reason-card">
        <div class="reason-img" data-img="reason3"><span class="num">3</span></div>
        <h3>デザイン力</h3>
        <p>暮らしになじむデザインで<br/>お家の魅力を引き立てます。</p>
      </article>
      <article class="reason-card">
        <div class="reason-img" data-img="reason4"><span class="num">4</span></div>
        <h3>安心の自社施工</h3>
        <p>熟練職人を自社で抱え、<br/>責任を持って施工します。</p>
      </article>
      <article class="reason-card">
        <div class="reason-img" data-img="reason5"><span class="num">5</span></div>
        <h3>充実のアフターサポート</h3>
        <p>お引き渡し後も定期点検や<br/>ご相談にしっかり対応します。</p>
      </article>
    </div>
  </div>
</section>

<!-- ============ FLOW ============ -->
<section class="section flow" id="flow">
  <div class="flow-inner">
    <div class="flow-head">
      <div class="eyebrow">FLOW</div>
      <h2 class="section-title">ご相談から完成までの流れ</h2>
      <p class="section-lead">初めての方でも安心していただけるシンプルなステップでご案内します。</p>
    </div>
    <ol class="flow-steps">
      <li>
        <div class="flow-icon"><svg viewBox="0 0 40 40" width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M8 12h24v16H16l-4 4v-4H8z"/></svg></div>
        <div class="step-num">01</div>
        <div class="step-title">ご相談・お問い合わせ</div>
        <div class="step-desc">お電話・メールにてお気軽にお問い合わせください。</div>
      </li>
      <li>
        <div class="flow-icon"><svg viewBox="0 0 40 40" width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.2"><circle cx="18" cy="18" r="8"/><path d="M24 24l8 8"/></svg></div>
        <div class="step-num">02</div>
        <div class="step-title">現地調査・ヒアリング</div>
        <div class="step-desc">現地を確認し、ご要望を詳しくお伺いします。</div>
      </li>
      <li>
        <div class="flow-icon"><svg viewBox="0 0 40 40" width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M10 8h16l6 6v18H10z"/><path d="M26 8v6h6"/><path d="M14 20h14M14 26h10"/></svg></div>
        <div class="step-num">03</div>
        <div class="step-title">プラン・お見積り提案</div>
        <div class="step-desc">ご要望にあわせたプランと<br/>お見積りをご提案。</div>
      </li>
      <li>
        <div class="flow-icon"><svg viewBox="0 0 40 40" width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M8 32V16l12-8 12 8v16"/><path d="M16 32v-8h8v8"/></svg></div>
        <div class="step-num">04</div>
        <div class="step-title">ご契約・工事開始</div>
        <div class="step-desc">ご契約後、日程を調整して<br/>着工いたします。</div>
      </li>
      <li>
        <div class="flow-icon"><svg viewBox="0 0 40 40" width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M8 32c4-6 10-10 16-10s12 4 16 10"/><path d="M16 22V10M24 22V14"/></svg></div>
        <div class="step-num">05</div>
        <div class="step-title">完成・お引き渡し</div>
        <div class="step-desc">完成後、ご確認のうえ<br/>お引き渡しいたします。</div>
      </li>
      <li>
        <div class="flow-icon"><svg viewBox="0 0 40 40" width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M20 8v6M20 26v6M8 20h6M26 20h6"/><circle cx="20" cy="20" r="5"/></svg></div>
        <div class="step-num">06</div>
        <div class="step-title">アフターサポート</div>
        <div class="step-desc">工事後もしっかりサポート<br/>いたします。</div>
      </li>
    </ol>
  </div>
</section>

<!-- ============ VOICE ============ -->
<section class="section voice" id="voice">
  <div class="voice-inner">
    <div class="voice-head">
      <div class="eyebrow">VOICE</div>
      <h2 class="section-title">お客様の声</h2>
      <p class="section-lead">たくさんのお客様の声をいただいています。</p>
    </div>
    <div class="voice-grid">
      <article class="voice-card">
        <div class="voice-img" data-img="voice1"></div>
        <p>イメージ以上の仕上がりで、<br/>本当にお願いしてよかったです。</p>
        <div class="voice-meta">Kさま</div>
      </article>
      <article class="voice-card">
        <div class="voice-img" data-img="voice2"></div>
        <p>子どもが喜ぶ庭が完成し、<br/>週末が待ち遠しくなりました。</p>
        <div class="voice-meta">Mさま</div>
      </article>
      <article class="voice-card">
        <div class="voice-img" data-img="voice3"></div>
        <p>相談しやすく、予算内で<br/>理想の外構が実現しました。</p>
        <div class="voice-meta">Tさま</div>
      </article>
      <article class="voice-card">
        <div class="voice-img" data-img="voice4"></div>
        <p>デザインも素敵で、何より<br/>夜の雰囲気が気に入っています。</p>
        <div class="voice-meta">Yさま</div>
      </article>
      <article class="voice-card">
        <div class="voice-img" data-img="voice5"></div>
        <p>アフターサポートも丁寧で、<br/>安心してお任せできます。</p>
        <div class="voice-meta">Yさま</div>
      </article>
    </div>
    <div class="voice-pager">
      <button class="pager-btn">‹</button>
      <button class="pager-btn">›</button>
    </div>
  </div>
</section>

<!-- ============ NEWS ============ -->
<section class="section news-ig">
  <div class="news-ig-inner" style="grid-template-columns: 1fr; max-width: 920px;">
    <div class="news" id="news">
      <div class="eyebrow">NEWS</div>
      <h2 class="section-title">ニュース・お知らせ</h2>
      <ul class="news-list">
        <?php
        $home_news = new WP_Query(
          array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 4,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'no_found_rows'  => true,
          )
        );
        if ( $home_news->have_posts() ):
          while ( $home_news->have_posts() ): $home_news->the_post();
            $h_cat   = ukai_post_news_category( get_the_ID() );
            $h_slug  = $h_cat ? $h_cat->slug : 'info';
            $h_class = ukai_news_tag_class( $h_slug );
            $h_name  = $h_cat ? $h_cat->name : 'お知らせ';
        ?>
        <li>
          <span class="news-date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></span>
          <span class="news-tag <?php echo esc_attr( $h_class ); ?>"><?php echo esc_html( $h_name ); ?></span>
          <a class="news-text" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
        </li>
        <?php
          endwhile;
          wp_reset_postdata();
        else:
        ?>
        <li>
          <span class="news-text" style="color: var(--ink-3)">投稿がありません。WordPress 管理画面の「ツール &gt; ニュースのサンプル投入」からサンプル記事を投入できます。</span>
        </li>
        <?php endif; ?>
      </ul>
      <a class="link-btn wide" href="/news/">すべてのニュースを見る<span class="arr">→</span></a>
    </div>
  </div>
</section>

<!-- ============ FAQ + CONTACT ============ -->
<section class="section faq-contact">
  <div class="faq-contact-inner">
    <div class="faq" id="faq">
      <div class="eyebrow">FAQ</div>
      <h2 class="section-title">よくあるご質問</h2>
      <ul class="faq-list">
        <li>
          <button class="faq-q" type="button">相談や見積もりだけでもお願いできますか？<span class="faq-toggle">+</span></button>
          <div class="faq-a"><p>はい、ご相談・お見積もりはすべて無料で承っております。お気軽にお問い合わせください。</p></div>
        </li>
        <li>
          <button class="faq-q" type="button">外構工事の費用はどのくらいかかりますか？<span class="faq-toggle">+</span></button>
          <div class="faq-a"><p>工事内容や規模によって異なりますが、玄関まわりのみで50〜150万円、お庭全体で200万円〜が一つの目安です。</p></div>
        </li>
        <li>
          <button class="faq-q" type="button">対応エリアはどこまでですか？<span class="faq-toggle">+</span></button>
          <div class="faq-a"><p>愛知県全域・岐阜県・三重県の一部を対応エリアとしております。エリア外の場合も、まずはご相談ください。</p></div>
        </li>
        <li>
          <button class="faq-q" type="button">小さな工事でも対応してもらえますか？<span class="faq-toggle">+</span></button>
          <div class="faq-a"><p>はい、植栽1本のお手入れからフェンス1枚の交換まで、規模を問わず対応しております。</p></div>
        </li>
      </ul>
      <a class="link-btn wide" href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">すべての質問を見る<span class="arr">→</span></a>
    </div>
    <aside class="contact-card" id="contact">
      <div class="contact-copy">
        <h3>理想の暮らしを、<br/>一緒にカタチにしませんか。</h3>
        <p>ご相談・お見積もりは無料です。<br/>お気軽にお問い合わせください。</p>
        <a class="btn btn-primary" href="https://docs.google.com/forms/d/e/1FAIpQLScjo7hymKSQXotVILgv59LAVYHmarkRy0b6zLCGdoaRWXskug/viewform" target="_blank" rel="noopener noreferrer">無料相談・お問い合わせはこちら<span class="arr">→</span></a>
      </div>
      <div class="contact-illust" data-img="family"></div>
    </aside>
  </div>
</section>

<!-- ============ CONTACT BAR ============ -->
<section class="contact-bar">
  <div class="contact-bar-inner">
    <div class="cb-item">
      <div class="cb-ic">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M4 5c0-.6.4-1 1-1h3l2 5-2 2c1 3 3 5 6 6l2-2 5 2v3c0 .6-.4 1-1 1A16 16 0 0 1 4 5z"/></svg>
      </div>
      <div class="cb-body">
        <div class="cb-sub">お電話でのお問い合わせ</div>
        <div class="cb-tel">090-3467-1335</div>
        <div class="cb-sub">営業時間 9:00–18:00（日曜定休）</div>
      </div>
    </div>
    <a class="cb-item cb-link" href="https://docs.google.com/forms/d/e/1FAIpQLScjo7hymKSQXotVILgv59LAVYHmarkRy0b6zLCGdoaRWXskug/viewform" target="_blank" rel="noopener noreferrer">
      <div class="cb-ic">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M3 6h18v12H3z"/><path d="M3 6l9 7 9-7"/></svg>
      </div>
      <div class="cb-body">
        <div class="cb-sub">メールでのお問い合わせ</div>
        <div class="cb-strong">お問い合わせフォームへ<span class="arr">→</span></div>
      </div>
    </a>
  </div>
</section>

<?php get_footer(); ?>

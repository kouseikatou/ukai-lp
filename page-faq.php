<?php
/**
 * Template Name: よくあるご質問
 *
 * @package UkaiKogyo
 */
get_header();
?>

<!-- HEADER -->
<header class="site-header">
  <div class="header-inner">
    <a href="/" class="logo">
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
      <a href="#service">サービス</a>
      <a href="#reason">庭づくりのこだわり</a>
      <a href="#voice">お客様の声</a>
      <a href="/news/">ニュース</a>
      <a href="/faq/" class="active">よくあるご質問</a>
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

<!-- PAGE HEAD -->
<section class="page-head">
  <div class="page-head-inner">
    <div class="eyebrow">FAQ</div>
    <h1 class="page-title">よくあるご質問</h1>
    <p class="page-lead">お客様からよくいただくご質問をまとめました。<br/>お探しのご質問が見つからない場合は、お気軽にお問い合わせください。</p>
    <nav class="breadcrumbs">
      <a href="/">トップ</a>
      <span>›</span>
      <span>よくあるご質問</span>
    </nav>
  </div>
</section>

<!-- CATEGORY NAV -->
<section class="faq-catnav-wrap">
  <div class="faq-catnav-inner">
    <a href="#cat-consult" class="faq-cat-link">
      <span class="fc-num">01</span>
      <span class="fc-label">ご相談・お見積もり</span>
    </a>
    <a href="#cat-cost" class="faq-cat-link">
      <span class="fc-num">02</span>
      <span class="fc-label">費用・お支払い</span>
    </a>
    <a href="#cat-work" class="faq-cat-link">
      <span class="fc-num">03</span>
      <span class="fc-label">工事について</span>
    </a>
    <a href="#cat-design" class="faq-cat-link">
      <span class="fc-num">04</span>
      <span class="fc-label">プラン・デザイン</span>
    </a>
    <a href="#cat-after" class="faq-cat-link">
      <span class="fc-num">05</span>
      <span class="fc-label">アフターサービス</span>
    </a>
  </div>
</section>

<!-- FAQ CATEGORIES -->
<section class="faq-archive">

  <!-- 01 ご相談・お見積もり -->
  <div class="faq-cat" id="cat-consult">
    <header class="faq-cat-head">
      <span class="fc-head-num">01</span>
      <h2 class="fc-head-title">ご相談・お見積もりについて</h2>
      <p class="fc-head-lead">初めてのご相談、訪問前の準備など、お問い合わせ時に多いご質問をまとめました。</p>
    </header>
    <ul class="faq-list">
      <li>
        <button class="faq-q">相談や見積もりだけでもお願いできますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>はい、ご相談・お見積もりはすべて無料で承っております。お気軽にお問い合わせください。プランの押し付けや無理な営業は一切いたしませんので、ご安心ください。</p></div>
      </li>
      <li>
        <button class="faq-q">対応エリアはどこまでですか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>愛知県全域・岐阜県・三重県の一部を対応エリアとしております。エリア外であっても、内容によってはご相談を承れる場合がございますので、まずはお問い合わせください。</p></div>
      </li>
      <li>
        <button class="faq-q">図面や資料がなくても相談できますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>もちろん大丈夫です。手書きのスケッチ・スマートフォンの写真・口頭でのイメージだけでもプランニングは可能です。現地調査の際に必要な情報を伺います。</p></div>
      </li>
      <li>
        <button class="faq-q">新築前でも相談できますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>新築計画中の段階からのご相談も歓迎しております。建物のプランと外構計画を並行して進めることで、より理想に近い住まいを実現できます。</p></div>
      </li>
      <li>
        <button class="faq-q">プラン提案までどのくらい時間がかかりますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>現地調査からプラン・お見積もりのご提示まで、通常1〜2週間ほどお時間をいただいております。繁忙期や工事規模により前後する場合がございます。</p></div>
      </li>
    </ul>
  </div>

  <!-- 02 費用 -->
  <div class="faq-cat" id="cat-cost">
    <header class="faq-cat-head">
      <span class="fc-head-num">02</span>
      <h2 class="fc-head-title">費用・お支払いについて</h2>
      <p class="fc-head-lead">ご予算やお支払い方法に関する、よくいただくご質問です。</p>
    </header>
    <ul class="faq-list">
      <li>
        <button class="faq-q">外構工事の費用はどのくらいかかりますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>工事内容や規模によって大きく異なりますが、玄関まわりのみで50〜150万円、お庭全体で200万円〜が一つの目安です。詳細はお見積もりにて丁寧にご説明いたします。</p></div>
      </li>
      <li>
        <button class="faq-q">予算内で収まるか不安です。相談できますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>ご予算をお伝えいただければ、その範囲内で実現できるプランをご提案いたします。優先順位を整理し、段階的に整えるご提案も可能です。</p></div>
      </li>
      <li>
        <button class="faq-q">お支払い方法を教えてください。<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>銀行振込にて、契約時・着工時・完了時の分割でのお支払いをお願いしております。リフォームローンのご紹介も可能ですので、お気軽にご相談ください。</p></div>
      </li>
      <li>
        <button class="faq-q">追加工事で費用が増えることはありますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>原則としてお見積もり金額を超える追加費用は発生いたしません。万が一、現場状況により追加が必要な場合は、必ず事前にご説明・ご了承をいただいた上で進めます。</p></div>
      </li>
    </ul>
  </div>

  <!-- 03 工事 -->
  <div class="faq-cat" id="cat-work">
    <header class="faq-cat-head">
      <span class="fc-head-num">03</span>
      <h2 class="fc-head-title">工事について</h2>
      <p class="fc-head-lead">工事期間や近隣への配慮など、施工に関するご質問です。</p>
    </header>
    <ul class="faq-list">
      <li>
        <button class="faq-q">小さな工事でも対応してもらえますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>はい、植栽1本のお手入れから、フェンス1枚の交換まで、規模を問わず対応しております。お気軽にご相談ください。</p></div>
      </li>
      <li>
        <button class="faq-q">工事期間はどのくらいですか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>玄関まわりのみで1〜2週間、お庭全体で3週間〜1ヶ月程度が目安です。天候や工事内容により前後しますが、着工前にスケジュールをご提示いたします。</p></div>
      </li>
      <li>
        <button class="faq-q">工事中、家にいる必要はありますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>ご在宅の必要はございません。お留守の間も責任を持って施工いたします。鍵の受け渡しなどが必要な場合は事前にご相談ください。</p></div>
      </li>
      <li>
        <button class="faq-q">近隣への配慮はしてもらえますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>着工前に近隣の方へのご挨拶を行い、騒音や粉塵への配慮、車両の駐車にも十分注意して施工いたします。気になる点があればいつでもお申し付けください。</p></div>
      </li>
      <li>
        <button class="faq-q">既存の植栽や石を活かせますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>もちろん可能です。思い出のある樹木や石組みを活かしたリデザインも、得意としております。現地で状態を確認し、ご提案いたします。</p></div>
      </li>
    </ul>
  </div>

  <!-- 04 デザイン -->
  <div class="faq-cat" id="cat-design">
    <header class="faq-cat-head">
      <span class="fc-head-num">04</span>
      <h2 class="fc-head-title">プラン・デザインについて</h2>
      <p class="fc-head-lead">デザインの方向性や、プランニングの進め方についてのご質問です。</p>
    </header>
    <ul class="faq-list">
      <li>
        <button class="faq-q">どんなテイストでも対応できますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>ナチュラル、和モダン、シンプルモダン、洋風ガーデンなど、幅広いテイストに対応しております。お客様のお家に調和するデザインをご提案します。</p></div>
      </li>
      <li>
        <button class="faq-q">手入れの少ない庭をつくれますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>はい、ローメンテナンスを意識した植栽選定や、雑草対策の下地処理など、お手入れの負担を軽減するご提案が可能です。</p></div>
      </li>
      <li>
        <button class="faq-q">ペットや小さな子どもが安全に過ごせる庭にできますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>転倒しにくい床材、毒性のない植物、視線を遮るフェンスなど、ご家族構成に合わせた安心の設計をいたします。</p></div>
      </li>
      <li>
        <button class="faq-q">パースや立体的な完成イメージはもらえますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>ご希望に応じて、3Dパース・立面図でのご提案が可能です。完成イメージを共有しながら、納得いただけるまでプランを練っていきます。</p></div>
      </li>
    </ul>
  </div>

  <!-- 05 アフター -->
  <div class="faq-cat" id="cat-after">
    <header class="faq-cat-head">
      <span class="fc-head-num">05</span>
      <h2 class="fc-head-title">アフターサービスについて</h2>
      <p class="fc-head-lead">工事完了後のメンテナンスや保証についてのご質問です。</p>
    </header>
    <ul class="faq-list">
      <li>
        <button class="faq-q">工事後の保証はありますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>はい、施工内容に応じて1〜10年の保証をお付けしております。詳しい保証内容は、ご契約時にご説明いたします。</p></div>
      </li>
      <li>
        <button class="faq-q">植栽が枯れてしまった場合は？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>植栽は1年間の枯れ保証をお付けしております（天災・剪定の不備などを除く）。お気軽にご連絡ください。</p></div>
      </li>
      <li>
        <button class="faq-q">定期的なメンテナンスはお願いできますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>剪定・除草・植え替え・清掃など、定期メンテナンスにも対応しております。年間契約・スポット対応どちらも可能です。</p></div>
      </li>
      <li>
        <button class="faq-q">他社で施工した外構の修繕も依頼できますか？<span class="faq-toggle">+</span></button>
        <div class="faq-a"><p>はい、対応可能です。現地を拝見した上で、最適な修繕プランをご提案いたします。</p></div>
      </li>
    </ul>
  </div>

</section>

<!-- CTA -->
<section class="section faq-contact" style="padding-bottom:84px">
  <div class="faq-contact-inner" style="grid-template-columns: 1fr">
    <aside class="contact-card" style="max-width: 880px; margin: 0 auto; width: 100%">
      <div class="contact-copy">
        <h3>解決しないご質問は、<br/>お気軽にご相談ください。</h3>
        <p>ご相談・お見積もりは無料です。<br/>外構・お庭づくりの専門スタッフが丁寧にお答えいたします。</p>
        <a class="btn btn-primary" href="/contact/">無料相談・お問い合わせはこちら<span class="arr">→</span></a>
      </div>
      <div class="contact-illust" data-img="family"></div>
    </aside>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer">
  <div class="footer-inner">
    <a href="/" class="logo logo-footer">
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
      <a href="#service">サービス</a>
      <a href="#reason">庭づくりのこだわり</a>
      <a href="#voice">お客様の声</a>
      <a href="/news/">ニュース</a>
      <a href="/faq/">よくあるご質問</a>
      <a href="/company/">会社概要</a>
    </nav>
    <nav class="footer-sub">
      <a href="#">プライバシーポリシー</a>
      <a href="#">サイトマップ</a>
    </nav>
  </div>
  <div class="footer-copy">© UKAI KOGYO All Rights Reserved.</div>
</footer>


<?php get_footer(); ?>

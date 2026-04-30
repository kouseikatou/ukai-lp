// Mobile drawer menu — injected into all pages

(function(){
  const HOME = (typeof window !== 'undefined' && window.UKAI && window.UKAI.home) ? window.UKAI.home : '/';
  const NAV_ITEMS = [
    { href: HOME + 'works/', label: '施工事例', en: 'Works' },
    { href: HOME + '#service', label: 'サービス', en: 'Service' },
    { href: HOME + '#reason', label: '庭づくりのこだわり', en: 'Reason' },
    { href: HOME + '#voice', label: 'お客様の声', en: 'Voice' },
    { href: HOME + 'news/', label: 'ニュース', en: 'News' },
    { href: HOME + 'faq/', label: 'よくあるご質問', en: 'FAQ' },
    { href: HOME + 'company/', label: '会社概要', en: 'Company' },
  ];

  // Build drawer DOM
  const drawer = document.createElement('div');
  drawer.className = 'mobile-drawer';
  drawer.setAttribute('aria-hidden', 'true');
  drawer.innerHTML = `
    <div class="md-backdrop"></div>
    <aside class="md-panel" role="dialog" aria-label="メニュー">
      <div class="md-head">
        <a href="${HOME}" class="md-logo">
          <span class="md-logo-mark" aria-hidden="true">
            <svg viewBox="0 0 40 40" width="32" height="32"><path d="M6 30 L20 8 L34 30 L27 30 L20 18 L13 30 Z" fill="none" stroke="currentColor" stroke-width="1.4"/><path d="M12 30 L20 16 L28 30" fill="none" stroke="currentColor" stroke-width="1.4"/></svg>
          </span>
          <span class="md-logo-text">
            <span class="md-logo-ja">鵜飼工業</span>
            <span class="md-logo-en">UKAI KOGYO</span>
          </span>
        </a>
        <button class="md-close" aria-label="閉じる">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 5l14 14M19 5L5 19"/></svg>
        </button>
      </div>

      <nav class="md-nav">
        ${NAV_ITEMS.map((it, i)=>`
          <a href="${it.href}" class="md-nav-item">
            <span class="md-nav-num">${String(i+1).padStart(2,'0')}</span>
            <span class="md-nav-label">
              <span class="md-nav-ja">${it.label}</span>
              <span class="md-nav-en">${it.en}</span>
            </span>
            <span class="md-nav-arr">→</span>
          </a>
        `).join('')}
      </nav>

      <div class="md-cta">
        <a href="https://docs.google.com/forms/d/e/1FAIpQLScjo7hymKSQXotVILgv59LAVYHmarkRy0b6zLCGdoaRWXskug/viewform" target="_blank" rel="noopener noreferrer" class="md-cta-btn">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 6h18v12H3z"/><path d="M3 6l9 7 9-7"/></svg>
          ご相談・お問い合わせ
        </a>
        <a href="tel:0564000000" class="md-tel">
          <span class="md-tel-label">お電話でも</span>
          <span class="md-tel-num">0564-XX-XXXX</span>
          <span class="md-tel-hours">受付 9:00〜18:00 / 日曜定休</span>
        </a>
      </div>

      <div class="md-foot">
        <a href="#">プライバシーポリシー</a>
        <span class="md-copy">© UKAI KOGYO</span>
      </div>
    </aside>
  `;
  document.body.appendChild(drawer);

  // Open / close behavior
  const open = ()=>{
    drawer.classList.add('is-open');
    drawer.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  };
  const close = ()=>{
    drawer.classList.remove('is-open');
    drawer.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  };

  document.querySelectorAll('.hamburger').forEach(btn=>{
    btn.addEventListener('click', open);
  });
  drawer.querySelector('.md-close').addEventListener('click', close);
  drawer.querySelector('.md-backdrop').addEventListener('click', close);
  drawer.querySelectorAll('.md-nav-item, .md-cta-btn').forEach(a=>{
    a.addEventListener('click', ()=> setTimeout(close, 50));
  });
  document.addEventListener('keydown', e=>{
    if(e.key === 'Escape' && drawer.classList.contains('is-open')) close();
  });

  // Hamburger → animated X
  document.querySelectorAll('.hamburger').forEach(btn=>{
    btn.classList.add('hamburger-anim');
  });
  // toggle X look when drawer is open
  const obs = new MutationObserver(()=>{
    const isOpen = drawer.classList.contains('is-open');
    document.querySelectorAll('.hamburger').forEach(btn=>{
      btn.classList.toggle('is-active', isOpen);
    });
  });
  obs.observe(drawer, { attributes: true, attributeFilter: ['class'] });
})();

// Scroll-based animations + scroll progress + back-to-top + counter
(function(){
  // Honor reduced-motion only by skipping parallax / hero zoom; keep gentle reveals.

  // 1) Auto-tag common sections for reveal
  const REVEAL_SELECTORS = [
    '.section-head', '.work-card', '.reason-card', '.voice-card',
    '.service-item', '.flow-step', '.faq-q', '.contact-card',
    '.cb-item', '.news-item', '.na-item', '.ci-row',
    '.ch-timeline > li', '.cm-text', '.cm-figure',
    '.faq-cat', '.fc-head-num', '.cm-card', '.work-page-grid > .work-card',
    '.ig-cell', '.cta-card'
  ];
  document.querySelectorAll(REVEAL_SELECTORS.join(',')).forEach(el=>{
    el.classList.add('reveal');
  });

  // Stagger groups: parents whose children should reveal as a group
  const STAGGER_SELECTORS = [
    '.works-grid', '.reason-grid', '.voice-grid', '.ig-grid',
    '.service-list', '.flow-list', '.cm-cards', '.contact-methods-inner',
    '.work-page-grid', '.faq-list', '.news-grid'
  ];
  document.querySelectorAll(STAGGER_SELECTORS.join(',')).forEach(el=>{
    el.classList.add('reveal-stagger');
    // remove individual reveal on direct children to avoid double fade
    el.querySelectorAll(':scope > .reveal').forEach(c=>c.classList.remove('reveal'));
  });

  // 2) IntersectionObserver
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(en=>{
      if(en.isIntersecting){
        en.target.classList.add('is-in');
        io.unobserve(en.target);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

  document.querySelectorAll('.reveal, .reveal-stagger').forEach(el=> io.observe(el));

  // 3) Scroll progress bar
  const bar = document.createElement('div');
  bar.className = 'scroll-progress';
  document.body.appendChild(bar);

  // 4) Back-to-top button
  const btn = document.createElement('button');
  btn.className = 'to-top';
  btn.setAttribute('aria-label', 'ページトップへ');
  btn.innerHTML = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 19V5M5 12l7-7 7 7"/></svg>';
  btn.addEventListener('click', ()=> window.scrollTo({ top: 0, behavior: 'smooth' }));
  document.body.appendChild(btn);

  let ticking = false;
  const onScroll = ()=>{
    if(ticking) return;
    ticking = true;
    requestAnimationFrame(()=>{
      const h = document.documentElement;
      const max = h.scrollHeight - h.clientHeight;
      const p = max > 0 ? (h.scrollTop / max) * 100 : 0;
      bar.style.width = p + '%';
      btn.classList.toggle('is-visible', h.scrollTop > 480);
      ticking = false;
    });
  };
  document.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // 5) Hero parallax (gentle) — skip if reduced motion
  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const heroBg = document.getElementById('hero-bg');
  if(heroBg && !reduce){
    document.addEventListener('scroll', ()=>{
      const y = window.scrollY;
      if(y < 800){
        heroBg.style.transform = `translateY(${y * 0.18}px) scale(${1 + y * 0.0002})`;
      }
    }, { passive: true });
  }

  // 6) Number count-up (e.g. on company history years, stat numbers)
  const countEls = document.querySelectorAll('[data-count]');
  const countIO = new IntersectionObserver((entries)=>{
    entries.forEach(en=>{
      if(!en.isIntersecting) return;
      const el = en.target;
      const target = parseFloat(el.dataset.count);
      const dur = parseInt(el.dataset.countDur || '1200', 10);
      const start = performance.now();
      const from = 0;
      const ease = t=> 1 - Math.pow(1 - t, 3);
      const tick = (now)=>{
        const t = Math.min(1, (now - start) / dur);
        const v = from + (target - from) * ease(t);
        el.textContent = Math.round(v).toLocaleString('ja-JP');
        if(t < 1) requestAnimationFrame(tick);
        else el.textContent = target.toLocaleString('ja-JP');
      };
      requestAnimationFrame(tick);
      countIO.unobserve(el);
    });
  }, { threshold: 0.5 });
  countEls.forEach(el=> countIO.observe(el));

  // 6.5) Split page title characters for stagger reveal
  document.querySelectorAll('.page-title, .hero-title').forEach(el=>{
    if(el.dataset.split === 'done') return;
    const text = el.textContent;
    el.textContent = '';
    [...text].forEach((ch, i)=>{
      const span = document.createElement('span');
      span.className = 'split-char';
      span.textContent = ch === ' ' ? '\u00a0' : ch;
      span.style.transitionDelay = (i * 0.035) + 's';
      el.appendChild(span);
    });
    el.dataset.split = 'done';
    // Reveal when in view
    const sio = new IntersectionObserver(entries=>{
      entries.forEach(en=>{
        if(en.isIntersecting){
          el.querySelectorAll('.split-char').forEach(s=> s.classList.add('is-in'));
          sio.disconnect();
        }
      });
    }, { threshold: 0.3 });
    sio.observe(el);
  });

  // 6.6) Clip-reveal hero / page-head images
  document.querySelectorAll('.hero-bg, .cm-figure, .page-head-figure').forEach(el=>{
    el.classList.add('clip-reveal');
    requestAnimationFrame(()=>{
      requestAnimationFrame(()=> el.classList.add('is-in'));
    });
  });

  // 6.7) Eyebrow underline reveal in sync with section
  document.querySelectorAll('.eyebrow').forEach(el=>{
    const eio = new IntersectionObserver(entries=>{
      entries.forEach(en=>{
        if(en.isIntersecting){
          el.classList.add('is-in');
          eio.disconnect();
        }
      });
    }, { threshold: 0.6 });
    eio.observe(el);
  });

  // 7) Smooth scroll for in-page anchors (extra easing)
  document.querySelectorAll('a[href^="#"]').forEach(a=>{
    const h = a.getAttribute('href');
    if(h.length < 2) return;
    a.addEventListener('click', e=>{
      const tgt = document.querySelector(h);
      if(!tgt) return;
      e.preventDefault();
      const y = tgt.getBoundingClientRect().top + window.scrollY - 72;
      window.scrollTo({ top: y, behavior: 'smooth' });
    });
  });
})();

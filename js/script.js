// Image binding — map data-img keys to file paths.
// WordPress 用に window.UKAI.assets でテーマアセット URI を受け取る
const ASSETS = (typeof window !== 'undefined' && window.UKAI && window.UKAI.assets) ? window.UKAI.assets : 'assets';
const IMG = {
  hero: ASSETS + '/hero-sunset.png',
  work1: ASSETS + '/material4.jpg',
  work2: ASSETS + '/material1.jpg',
  work3: ASSETS + '/work1.png',
  work4: ASSETS + '/work2.png',
  work5: ASSETS + '/work3.png',
  work6: ASSETS + '/work5.png',
  reason1: ASSETS + '/reason1.png',
  reason2: ASSETS + '/reason2.png',
  reason3: ASSETS + '/reason3.png',
  reason4: ASSETS + '/reason4.png',
  reason5: ASSETS + '/reason5.png',
  voice1: ASSETS + '/voice1.png',
  voice2: ASSETS + '/voice2.png',
  voice3: ASSETS + '/voice3.png',
  voice4: ASSETS + '/voice4.png',
  voice5: ASSETS + '/voice5.png',
  ig1: ASSETS + '/material1.jpg',
  ig2: ASSETS + '/ig1.jpg',
  ig3: ASSETS + '/material3.jpg',
  ig4: ASSETS + '/ig2.jpg',
  ig5: ASSETS + '/material2.jpg',
  ig6: ASSETS + '/ig3.jpg',
  family: ASSETS + '/family.png',
  logo: ASSETS + '/logo.png',
};

// Probe each image; if it loads, bind it; otherwise paint a striped placeholder with label.
function stripedPlaceholder(label){
  const svg = `<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'>
    <defs><pattern id='p' width='14' height='14' patternUnits='userSpaceOnUse' patternTransform='rotate(45)'>
      <rect width='14' height='14' fill='#efece4'/>
      <rect width='7' height='14' fill='#e6e2d6'/>
    </pattern></defs>
    <rect width='200' height='200' fill='url(#p)'/>
    <text x='100' y='104' text-anchor='middle' font-family='ui-monospace,Menlo,monospace' font-size='10' fill='#8a8f89'>${label}</text>
  </svg>`;
  return `url("data:image/svg+xml;utf8,${encodeURIComponent(svg)}")`;
}

document.querySelectorAll('[data-img]').forEach(el=>{
  const key = el.getAttribute('data-img');
  const src = IMG[key];
  const isContain = el.classList.contains('contact-illust');
  if(!src){
    el.style.backgroundImage = stripedPlaceholder(key);
    return;
  }
  const img = new Image();
  img.onload = ()=>{
    el.style.backgroundImage = `url("${src}")`;
    if(isContain){
      el.style.backgroundSize = 'contain';
    }
  };
  img.onerror = ()=>{ el.style.backgroundImage = stripedPlaceholder(key); };
  img.src = src;
});

// Hero bg
(function(){
  const hero = document.getElementById('hero-bg');
  if(!hero) return;
  const img = new Image();
  img.onload = ()=>{
    hero.style.backgroundImage = `linear-gradient(180deg, rgba(20,25,20,.08) 0%, rgba(20,25,20,.4) 100%), url("${IMG.hero}")`;
    hero.style.backgroundSize = 'cover';
    hero.style.backgroundPosition = 'center 45%';
    hero.classList.add('loaded');
  };
  img.onerror = ()=>{
    hero.style.backgroundImage = stripedPlaceholder('HERO / 外観写真');
    hero.style.backgroundSize = 'cover';
    hero.style.backgroundPosition = 'center';
  };
  img.src = IMG.hero;
})();

// FAQ toggle
document.querySelectorAll('.faq-q').forEach(btn=>{
  btn.addEventListener('click', ()=>{
    btn.classList.toggle('open');
    const t = btn.querySelector('.faq-toggle');
    t.textContent = btn.classList.contains('open') ? '−' : '+';
  });
});

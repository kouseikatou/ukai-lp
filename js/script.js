// Image binding — map data-img keys to file paths.
// WordPress 用に window.UKAI.assets でテーマアセット URI を受け取る
const THEME = (typeof window !== 'undefined' && window.UKAI && window.UKAI.theme) ? window.UKAI.theme : '';
const ASSETS = (typeof window !== 'undefined' && window.UKAI && window.UKAI.assets) ? window.UKAI.assets : 'assets';
const UPLOADS = THEME ? THEME + '/uploads' : 'uploads';
const IMG = {
  hero: ASSETS + '/works-twilight-lighting.jpg',
  heroMain: ASSETS + '/hero.png',
  heroSunset: ASSETS + '/hero-sunset.png',
  work1: ASSETS + '/natural-work-garden.jpg',
  work2: ASSETS + '/works-navy-siding.jpg',
  work3: ASSETS + '/works-black-fence.jpg',
  work4: ASSETS + '/natural-work-entrance.jpg',
  work5: ASSETS + '/natural-work-approach.jpg',
  work6: ASSETS + '/works-wa-modern.jpg',
  workPng1: ASSETS + '/work1.png',
  workPng2: ASSETS + '/work2.png',
  workPng3: ASSETS + '/work3.png',
  workPng4: ASSETS + '/work4.png',
  workPng5: ASSETS + '/work5.png',
  worksBlackFence: ASSETS + '/works-black-fence.jpg',
  worksNavy: ASSETS + '/works-navy-siding.jpg',
  worksTwilight: ASSETS + '/works-twilight-lighting.jpg',
  worksWa: ASSETS + '/works-wa-modern.jpg',
  reason1: ASSETS + '/reason-hearing.jpg',
  reason2: ASSETS + '/reason-price.jpg',
  reason3: ASSETS + '/reason-design.jpg',
  reason4: ASSETS + '/reason-construction.jpg',
  reason5: ASSETS + '/reason-support.jpg',
  voice1: ASSETS + '/voice-finish-okazaki.jpg',
  voice2: ASSETS + '/voice-family-garden.jpg',
  voice3: ASSETS + '/voice-budget-exterior.jpg',
  voice4: ASSETS + '/voice-night-lighting.jpg',
  voice5: ASSETS + '/voice-after-support.jpg',
  voiceAfter: ASSETS + '/voice-after-support.jpg',
  voiceBudget: ASSETS + '/voice-budget-exterior.jpg',
  voiceFamily: ASSETS + '/voice-family-garden.jpg',
  voiceFinish: ASSETS + '/voice-finish-okazaki.jpg',
  voiceNight: ASSETS + '/voice-night-lighting.jpg',
  ig1: ASSETS + '/works-interior-living.jpg',
  ig2: ASSETS + '/works-interior-kitchen.jpg',
  ig3: ASSETS + '/works-interior-dining.jpg',
  ig4: ASSETS + '/works-wa-modern.jpg',
  ig5: ASSETS + '/works-seasonal-planting.jpg',
  ig6: ASSETS + '/works-twilight-lighting.jpg',
  worksConstruction: ASSETS + '/works-construction-site.jpg',
  worksPlanting: ASSETS + '/works-seasonal-planting.jpg',
  naturalGarden: ASSETS + '/natural-work-garden.jpg',
  naturalEntrance: ASSETS + '/natural-work-entrance.jpg',
  naturalApproach: ASSETS + '/natural-work-approach.jpg',
  materialPlanter: ASSETS + '/material4.jpg',
  materialExterior: ASSETS + '/material1.jpg',
  materialCivil: ASSETS + '/material3.jpg',
  genExterior1: ASSETS + '/generated-works/works-generated-01.webp',
  genCarport1: ASSETS + '/generated-works/works-generated-02.webp',
  genFence1: ASSETS + '/generated-works/works-generated-03.webp',
  genTurf1: ASSETS + '/generated-works/works-generated-04.webp',
  genConcrete1: ASSETS + '/generated-works/works-generated-05.webp',
  genBlock1: ASSETS + '/generated-works/works-generated-06.webp',
  genCivil1: ASSETS + '/generated-works/works-generated-07.webp',
  genApproach1: ASSETS + '/generated-works/works-generated-08.webp',
  genConcrete2: ASSETS + '/generated-works/works-generated-09.webp',
  genCivil2: ASSETS + '/generated-works/works-generated-10.webp',
  genCivil3: ASSETS + '/generated-works/works-generated-11.webp',
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

// FAQ toggle
document.querySelectorAll('.faq-q').forEach((btn, index)=>{
  const panel = btn.nextElementSibling && btn.nextElementSibling.classList.contains('faq-a')
    ? btn.nextElementSibling
    : null;

  if(!btn.hasAttribute('type')){
    btn.setAttribute('type', 'button');
  }

  if(panel){
    if(!panel.id){
      panel.id = `faq-answer-${index + 1}`;
    }
    btn.setAttribute('aria-controls', panel.id);
  }

  const setOpen = (isOpen)=>{
    btn.classList.toggle('is-open', isOpen);
    btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

    if(panel){
      panel.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
    }

    const t = btn.querySelector('.faq-toggle');
    if(t){
      t.textContent = isOpen ? '−' : '+';
    }
  };

  setOpen(btn.classList.contains('is-open') || btn.getAttribute('aria-expanded') === 'true');

  btn.addEventListener('click', ()=>{
    setOpen(btn.getAttribute('aria-expanded') !== 'true');
  });
});

// Add a few more img keys used by works.html
(function ensureExtraImageKeys(){
  if(typeof window.__IMG_EXTRA !== 'undefined') return;
  // Re-bind data-img on any cell using keys that aren't in the main IMG map
  // by pointing them to known files.
  const ASSETS = (typeof window !== 'undefined' && window.UKAI && window.UKAI.assets) ? window.UKAI.assets : 'assets';
  const extraSrc = {
    material3: ASSETS + '/material3.jpg',
  };
  document.querySelectorAll('[data-img]').forEach(el=>{
    const key = el.getAttribute('data-img');
    if(!extraSrc[key]) return;
    if(el.style.backgroundImage && el.style.backgroundImage !== 'none') return;
    const img = new Image();
    img.onload = ()=>{ el.style.backgroundImage = `url("${extraSrc[key]}")`; };
    img.src = extraSrc[key];
  });
  window.__IMG_EXTRA = true;
})();

// FILTERS
const state = { taste: 'all', budget: 'all', cat: 'all' };

function applyFilters(){
  const cards = document.querySelectorAll('.wa-card');
  let visible = 0;
  cards.forEach(card=>{
    const taste = card.dataset.taste || '';
    const budget = card.dataset.budget || '';
    const cats = (card.dataset.cat || '').split(/\s+/);
    const ok =
      (state.taste === 'all' || taste === state.taste) &&
      (state.budget === 'all' || budget === state.budget) &&
      (state.cat === 'all' || cats.includes(state.cat));
    card.classList.toggle('is-hidden', !ok);
    if(ok) visible++;
  });
  const cnt = document.getElementById('result-count');
  if(cnt) cnt.textContent = visible;
}

document.querySelectorAll('.chips').forEach(group=>{
  const filter = group.dataset.filter;
  group.querySelectorAll('.chip').forEach(chip=>{
    chip.addEventListener('click', ()=>{
      group.querySelectorAll('.chip').forEach(c=>c.classList.remove('active'));
      chip.classList.add('active');
      state[filter] = chip.dataset.value;
      applyFilters();
    });
  });
});

// initial count
applyFilters();

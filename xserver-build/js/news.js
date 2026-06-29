// News filtering + search

const newsState = { cat: 'all', q: '' };

function applyNewsFilters(){
  const items = document.querySelectorAll('.na-item');
  const q = newsState.q.trim().toLowerCase();
  items.forEach(item=>{
    const cat = item.dataset.cat || '';
    const text = item.textContent.toLowerCase();
    const ok =
      (newsState.cat === 'all' || cat === newsState.cat) &&
      (q === '' || text.includes(q));
    item.classList.toggle('is-hidden', !ok);
  });
  // hide empty year groups
  document.querySelectorAll('.news-year').forEach(year=>{
    const visible = year.querySelectorAll('.na-item:not(.is-hidden)').length;
    year.style.display = visible === 0 ? 'none' : '';
  });
}

document.querySelectorAll('.news-tabs .news-tab').forEach(tab=>{
  tab.addEventListener('click', ()=>{
    document.querySelectorAll('.news-tabs .news-tab').forEach(t=>t.classList.remove('active'));
    tab.classList.add('active');
    newsState.cat = tab.dataset.value;
    applyNewsFilters();
  });
});

const searchInput = document.getElementById('news-search-input');
if(searchInput){
  searchInput.addEventListener('input', e=>{
    newsState.q = e.target.value;
    applyNewsFilters();
  });
}

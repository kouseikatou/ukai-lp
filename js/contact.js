// Contact form — light client-side helpers

(function(){
  const form = document.getElementById('contact-form');
  if(!form) return;

  // Auto-format zip
  const zip = form.querySelector('#zip');
  if(zip){
    zip.addEventListener('input', e=>{
      let v = e.target.value.replace(/[^0-9]/g, '').slice(0, 7);
      if(v.length > 3) v = v.slice(0,3) + '-' + v.slice(3);
      e.target.value = v;
    });
  }

  // Submit handler (placeholder — confirms entry)
  form.addEventListener('submit', e=>{
    e.preventDefault();
    const agree = form.querySelector('#agree');
    if(!agree.checked){
      alert('プライバシーポリシーへの同意が必要です。');
      return;
    }
    const required = form.querySelectorAll('[required]');
    let firstInvalid = null;
    required.forEach(el=>{
      if(!el.value || (el.type === 'checkbox' && !el.checked)){
        if(!firstInvalid) firstInvalid = el;
      }
    });
    if(firstInvalid){
      alert('必須項目をご入力ください。');
      firstInvalid.focus();
      return;
    }
    alert('お問い合わせを受け付けました。\n2営業日以内にご連絡いたします。\n（このページはデモのため、実際の送信は行われません。）');
  });
})();

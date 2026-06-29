<?php
/**
 * Template Name: お問い合わせ
 *
 * @package UkaiKogyo
 */
get_header();
?>

<!-- PAGE HEAD -->
<section class="page-head">
  <div class="page-head-inner">
    <div class="eyebrow">CONTACT</div>
    <h1 class="page-title">お問い合わせ</h1>
    <p class="page-lead">外構・お庭づくりのご相談、お見積もりのご依頼など、<br/>お気軽にお問い合わせください。担当者より2営業日以内にご連絡いたします。</p>
    <nav class="breadcrumbs">
      <a href="/">トップ</a>
      <span>›</span>
      <span>お問い合わせ</span>
    </nav>
  </div>
</section>

<!-- CONTACT METHODS -->
<section class="contact-methods-wrap">
  <div class="contact-methods-inner">
    <div class="cm-card">
      <div class="cm-num">01</div>
      <div class="cm-icon" aria-hidden="true">
        <svg viewBox="0 0 32 32" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M5 9h22v18H5z"/><path d="M5 9l11 9 11-9"/></svg>
      </div>
      <div class="cm-label">メールフォームから</div>
      <div class="cm-desc">24時間受付・2営業日以内にご返信</div>
    </div>
    <div class="cm-card">
      <div class="cm-num">02</div>
      <div class="cm-icon" aria-hidden="true">
        <svg viewBox="0 0 32 32" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M7 5h6l3 7-4 3a16 16 0 008 8l3-4 7 3v6a2 2 0 01-2 2A22 22 0 015 7a2 2 0 012-2z"/></svg>
      </div>
      <div class="cm-label">お電話でのお問い合わせ</div>
      <div class="cm-tel">090-3467-1335</div>
      <div class="cm-desc">営業時間 9:00–18:00（日曜定休）</div>
    </div>
    <div class="cm-card">
      <div class="cm-num">03</div>
      <div class="cm-icon" aria-hidden="true">
        <svg viewBox="0 0 32 32" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M16 4a10 10 0 0110 10c0 7-10 16-10 16S6 21 6 14A10 10 0 0116 4z"/><circle cx="16" cy="14" r="3.5"/></svg>
      </div>
      <div class="cm-label">直接ご来店も歓迎</div>
      <div class="cm-desc">愛知県岡崎市〇〇町〇-〇<br/>事前にご連絡いただけるとスムーズです</div>
    </div>
  </div>
</section>

<!-- FORM -->
<section class="form-section">
  <div class="form-inner">

    <!-- LEFT — intro / steps -->
    <aside class="form-aside">
      <div class="form-aside-block">
        <div class="eyebrow">FLOW</div>
        <h2 class="aside-title">お問い合わせから<br/>施工までの流れ</h2>
      </div>

      <ol class="flow-list">
        <li>
          <div class="fl-num">01</div>
          <div class="fl-body">
            <div class="fl-label">お問い合わせ</div>
            <p>フォーム・お電話にてご連絡ください。</p>
          </div>
        </li>
        <li>
          <div class="fl-num">02</div>
          <div class="fl-body">
            <div class="fl-label">ヒアリング・現地調査</div>
            <p>ご要望を伺い、現地を拝見させていただきます。</p>
          </div>
        </li>
        <li>
          <div class="fl-num">03</div>
          <div class="fl-body">
            <div class="fl-label">プラン・お見積もり</div>
            <p>1〜2週間後、図面とお見積もりをご提示します。</p>
          </div>
        </li>
        <li>
          <div class="fl-num">04</div>
          <div class="fl-body">
            <div class="fl-label">ご契約・着工</div>
            <p>内容にご納得いただけましたら、ご契約・施工へ。</p>
          </div>
        </li>
        <li>
          <div class="fl-num">05</div>
          <div class="fl-body">
            <div class="fl-label">お引き渡し・アフター</div>
            <p>完成のご確認後、保証書をお渡しいたします。</p>
          </div>
        </li>
      </ol>

      <div class="aside-note">
        <div class="an-title">ご返信について</div>
        <p>営業時間内（9:00–18:00 / 日曜定休）にいただいたお問い合わせは、当日中にご返信いたします。お急ぎの方はお電話（090-3467-1335）までお願いいたします。</p>
      </div>
    </aside>

    <!-- RIGHT — form -->
    <form class="contact-form" id="contact-form" novalidate>
      <div class="form-head">
        <div class="eyebrow">FORM</div>
        <h2 class="form-title">お問い合わせフォーム</h2>
        <p class="form-note"><span class="req-mark">*</span> は入力必須項目です。</p>
      </div>

      <div class="field">
        <label>お問い合わせ種別 <span class="req-mark">*</span></label>
        <div class="radio-group">
          <label class="radio-pill"><input type="radio" name="type" value="新築外構" checked /><span>新築外構</span></label>
          <label class="radio-pill"><input type="radio" name="type" value="リフォーム" /><span>リフォーム</span></label>
          <label class="radio-pill"><input type="radio" name="type" value="お庭づくり" /><span>お庭づくり</span></label>
          <label class="radio-pill"><input type="radio" name="type" value="メンテナンス" /><span>メンテナンス</span></label>
          <label class="radio-pill"><input type="radio" name="type" value="その他" /><span>その他</span></label>
        </div>
      </div>

      <div class="field-row">
        <div class="field">
          <label for="lname">お名前 <span class="req-mark">*</span></label>
          <input type="text" id="lname" name="lname" placeholder="山田 太郎" required />
        </div>
        <div class="field">
          <label for="kana">フリガナ</label>
          <input type="text" id="kana" name="kana" placeholder="ヤマダ タロウ" />
        </div>
      </div>

      <div class="field-row">
        <div class="field">
          <label for="email">メールアドレス <span class="req-mark">*</span></label>
          <input type="email" id="email" name="email" placeholder="example@email.com" required />
        </div>
        <div class="field">
          <label for="tel">お電話番号</label>
          <input type="tel" id="tel" name="tel" placeholder="090-0000-0000" />
        </div>
      </div>

      <div class="field">
        <label for="zip">郵便番号</label>
        <input type="text" id="zip" name="zip" placeholder="000-0000" class="input-narrow" />
      </div>

      <div class="field">
        <label for="address">ご住所（施工予定地）</label>
        <input type="text" id="address" name="address" placeholder="愛知県岡崎市〇〇町〇-〇" />
      </div>

      <div class="field-row">
        <div class="field">
          <label for="budget">ご予算</label>
          <div class="select-wrap">
            <select id="budget" name="budget">
              <option value="">選択してください</option>
              <option>〜100万円</option>
              <option>100〜200万円</option>
              <option>200〜300万円</option>
              <option>300〜500万円</option>
              <option>500万円以上</option>
              <option>未定・相談したい</option>
            </select>
          </div>
        </div>
        <div class="field">
          <label for="timing">ご希望時期</label>
          <div class="select-wrap">
            <select id="timing" name="timing">
              <option value="">選択してください</option>
              <option>1ヶ月以内</option>
              <option>1〜3ヶ月以内</option>
              <option>3〜6ヶ月以内</option>
              <option>半年〜1年以内</option>
              <option>未定</option>
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label>ご興味のある内容（複数選択可）</label>
        <div class="check-grid">
          <label class="check-pill"><input type="checkbox" name="interest" value="駐車場・カーポート" /><span>駐車場・カーポート</span></label>
          <label class="check-pill"><input type="checkbox" name="interest" value="玄関アプローチ" /><span>玄関アプローチ</span></label>
          <label class="check-pill"><input type="checkbox" name="interest" value="フェンス・門" /><span>フェンス・門</span></label>
          <label class="check-pill"><input type="checkbox" name="interest" value="ウッドデッキ" /><span>ウッドデッキ</span></label>
          <label class="check-pill"><input type="checkbox" name="interest" value="植栽・庭" /><span>植栽・庭</span></label>
          <label class="check-pill"><input type="checkbox" name="interest" value="ライティング" /><span>ライティング</span></label>
          <label class="check-pill"><input type="checkbox" name="interest" value="目隠し・プライバシー" /><span>目隠し・プライバシー</span></label>
          <label class="check-pill"><input type="checkbox" name="interest" value="その他" /><span>その他</span></label>
        </div>
      </div>

      <div class="field">
        <label for="message">ご相談内容 <span class="req-mark">*</span></label>
        <textarea id="message" name="message" rows="6" placeholder="お庭の現状・ご希望のイメージ・お悩みなど、お気軽にご記入ください。" required></textarea>
      </div>

      <div class="field">
        <label>当社をお知りになったきっかけ</label>
        <div class="select-wrap">
          <select name="source">
            <option value="">選択してください</option>
            <option>インターネット検索</option>
            <option>SNS（Instagram など）</option>
            <option>知人・ご家族の紹介</option>
            <option>イベント・展示会</option>
            <option>看板・チラシ</option>
            <option>その他</option>
          </select>
        </div>
      </div>

      <div class="field consent">
        <label class="consent-row">
          <input type="checkbox" id="agree" name="agree" required />
          <span><a href="#">プライバシーポリシー</a>に同意します <span class="req-mark">*</span></span>
        </label>
      </div>

      <div class="form-submit">
        <button type="submit" class="btn-submit">この内容で送信する<span class="arr">→</span></button>
        <p class="submit-note">送信後、自動返信メールをお送りします。<br class="hide-pc"/>担当者より2営業日以内にご連絡いたします。</p>
      </div>

    </form>
  </div>
</section>

<?php get_footer(); ?>

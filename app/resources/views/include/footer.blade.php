

<script>
$(function(){
  var pagetop = $('#page_top');
  // ボタン非表示
  pagetop.hide();
  // 100px スクロールしたらボタン表示
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      pagetop.fadeIn();
    } else {
      pagetop.fadeOut();
    }
  });
  pagetop.click(function () {
    $('body, html').animate({ scrollTop: 0 }, 500);
    return false;
  });
});
</script>
<div class="topback_button" id="page_top">
  <div class="topback_img">
    <svg xmlns="/assets/img/item/arrow-up-square-fill.svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-up-square-fill" viewBox="0 0 16 16">
      <path d="M2 16a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2zm6.5-4.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 1 0z"/>
    </svg>
  </div>
</div>
<footer class="footer hr">
  <div class="container footer-menu">
    <div class="row mt50">
      <div class="col-md-4">
        <ul>
          <li><a href="/contact">お問い合わせ</a></li>
          <li><a href="#">利用規約</a></li>
          <li><a href="#">プライバシーポリシー</a></li>
          <li><a href="#">特定商取引法に基づく表記</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <ul>
          <li><a href="#">当サイトについて</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Instagram</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <ul>
          <li><a href="#">商品一覧</a></li>
          <li><a href="#">Document Top</a></li>
          <li><a href="#">Archives</a></li>
        </ul>
      </div>
    </div>
  </div>
	<div class="copy-right text-align-center mt20 mb20">
		<p class="text-center">© 2022 Insomnia Roughlang, INC. All Rights Reserved</p>
	</div>
</footer>

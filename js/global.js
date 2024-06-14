$(function() {
	// スマホ用ナビ開閉
$('#nav_sp').on('click', function() {
	$(this).toggleClass('open');
	$('nav').slideToggle();
});
});

	$(function() {
			var offset = $('nav').offset();
		
			$(window).scroll(function () {
				if ($(window).scrollTop() > offset.top) {
					$('article').addClass('fixed');
					$('#home_key_area').addClass('fixed');
				} else {
					$('article').removeClass('fixed');
					$('#home_key_area').removeClass('fixed');
				}
			});
		});
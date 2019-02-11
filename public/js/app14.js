$(function() {
	$('#btn-toggle-search').click(function() {
		$('#search-form-top').slideToggle(250);
		$('#search-form-top input').focus();
	});

	$('img').on('error', function() {
		$(this).attr('src', '/img/150x150.gif');
	})

	$(".dropdown").hover(
		function() {
			$('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
			$(this).toggleClass('open');
		},
		function() {
			$('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
			$(this).toggleClass('open');
		}
	);

	$('#tutorial').sidr({
		source: '.fsd-nav-menu',
		side: 'right'
	});

	// Check event to scroll window is top > 1500 to display
	$(window).scroll(function(){
		if ($(this).scrollTop() > 1500) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
	});

	//Click event to scroll to top
	$('.scrollToTop').click(function(){
		$('html, body').animate({ scrollTop : 0 }, 500);
		return false;
	});

	/*
	* Click event remove
	*/
	$('.js_remover').click(function(ev) {
		ev.preventDefault();
      var answer = confirm('Bạn có chắc chắn muốn xóa bản ghi này?');
      if (answer) return window.location.href = $(this).attr('href');
      else return false;
	});
});

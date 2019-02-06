$(function() {
	// Recommend post
	$('.fsd-btn-recommend').on('click', onClickBtnRecommend);

	function onClickBtnRecommend(e) {
		e.preventDefault();

		var $this = $(this);
		var postId = $this.data('post');
		var token = $this.data('token');

		var recommend = new Recommend(postId, token);

		recommend.addRecommendPost().success(function(response) {
			console.log(response);
			if(response.code == 2) {
				alert(response.message);
				window.location.href = response.url_login;
			}else if(response.code == 0) {
				alert(response.message);
			}
			// Recommend
			else if(response.code == 1) {
				$this.find('.fa')
				     .removeClass('fa-heart-o')
				     .removeClass('fa-heart')
				     .removeClass('fsd-heart')
				     .addClass('fa-heart fsd-heart');
			}
			// Unrecommend
			else if(response.code == -1) {
				$this.find('.fa')
				     .removeClass('fa-heart-o')
				     .removeClass('fa-heart')
				     .removeClass('fsd-heart')
				     .addClass('fa-heart-o');
			}
		});
	}
});
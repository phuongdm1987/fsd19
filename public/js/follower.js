$(function(){
	$('.js-btn-follow').on('click', function() {
		var $this = $(this);
		$.ajax({
			url : '/author/setFollower',
			type : 'POST',
			dataType : 'json',
			data : {
				fid : $this.data('uid'),
				url_return : $this.data('urlreturn'),
				_token : $this.data('token')
			},
			success : function(data) {
				// Bỏ theo dõi thành công
				if(data.code === 1) {
					$this.html(data.text);
					$this.removeClass('btn-info').addClass('btn-danger');
				}
				// Theo dõi thành công
				else if(data.code === 4) {
					$this.html(data.text);
					$this.removeClass('btn-danger').addClass('btn-info');
				}
				// Đăng nhập
				else if(data.code === 2) {
					alert(data.message);
					window.location.href = data.url_login;
				}
				// Không thể tự follow mình
				else if(data.code === 3) {
					alert(data.message);
				}
				else{
					alert(data.message);
				}
			}
		});

		return false;
	});
})
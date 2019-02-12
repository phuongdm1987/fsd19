$(function(){
	var token = $('body').data('token');
	var avatarPickerControls, coverPickerControls, fsdButtonControl, fsdButtonEdit;
	avatarPickerControls = $('.avatarPickerControls');
	coverPickerControls  = $('.coverPickerControls');
	fsdButtonControl 		= $('#fsd-button-control');
	fsdButtonEdit 			= $('#fsd-button-edit');

	// Edit profile
	$('#fsd-button-edit').click(function(){
		$(this).hide();
		fsdButtonControl.removeClass('hide');
		if(avatarPickerControls.hasClass('hide') && coverPickerControls.hasClass('hide')){
			avatarPickerControls.removeClass('hide');
			coverPickerControls.removeClass('hide');
		}
	});

	// Cancel
	$('#fsd-button-cancel').click(function(){
		avatarPickerControls.addClass('hide');
		coverPickerControls.addClass('hide');
		fsdButtonControl.addClass('hide');
		fsdButtonEdit.show();
	});

	// Js change upload cover
	$('#fsdCover').fileupload({
		url : '/author/cover?_token=' + token,
		dataType: 'json',
		done: function (e, data) {
			//$('.fsd-coverPickerOut img').attr('src', data.result.path);
			coverPickerControls.addClass('hide');
			$('.fsdCoverOuter').css('background-image', 'url('+ data.result.path +')');
			$('#cover').val(data.result.file_name);
		},
	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

	// Js change upload avatar
	$('#fsdAvatar').fileupload({
		url : '/author/avatar?_token=' + token,
		dataType: 'json',
		done: function(e, data){
			$('.fsd-avatar-image').css('background-image', 'url('+ data.result.path +')');
			$('#avatar').val(data.result.file_name);
			avatarPickerControls.addClass('hide');
		},
	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

	// Save change cover and avatar
	$('#fsd-button-save').click(function(){
		$.ajax({
			url: '/author/store',
			type: 'POST',
			data: {
				cover: $('#cover').val(),
				avatar: $('#avatar').val(),
				_token: token
			},
			success : function (result){
           	if(result.code == 1){
           		setTimeout(function() {
			        $.bootstrapGrowl(result.message, {
				        	type: 'success',
				        	align: 'center',
         				width: 'auto',
         				allow_dismiss: false
      				});
			        fsdButtonControl.addClass('hide');
			        avatarPickerControls.addClass('hide');
			        coverPickerControls.addClass('hide');
			        fsdButtonEdit.show();
			    	}, 1000);
           	}
        	}
		});
	});
});
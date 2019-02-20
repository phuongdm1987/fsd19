var relatedLinks = [];

$(function() {
	// Nếu có thông tin bài viết liên quan thì fill vào mảng replatedLinks
	relatedLinks = $('#addition-links').val().split(',');

	// Typeahead
	//
	var articleSource = new Bloodhound({
		datumTokenizer: function (d) {
			return Bloodhound.tokenizers.whitespace(d.value);
		},
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		remote: {
			url: '/ajax/posts/suggest?q=%QUERY',
			filter: function (article) {
				return $.map(article, function (data) {
					return {
						value: data.title,
						id: data.id
					};
				});
			}
		}
	});

	articleSource.initialize();

	$('.typeahead').typeahead({
		highlight: true
	},
	{
		name: 'posts',
		displayKey: 'value',
		source: articleSource.ttAdapter()
	}).on('typeahead:selected', function (e, datum) {
		$(this).data('item-selected', datum);
		addLinkHandle();
	});

	// Toggle setting sidebar
	//
	$('.footer-setting').click(function(ev) {
		ev.preventDefault();
		toggleSettingSidebar();
	});

	// Close setting sidebar
	//
	$('.close', '#sb-menu').click(toggleSettingSidebar);

   // Warning when delete an item
   //
   $('.btn-delete-action').click(function(ev) {
      ev.preventDefault();
      var answer = confirm('Bạn có chắc chắn muốn xóa bản ghi này?');
      if (answer) return window.location.href = $(this).attr('href');
      else return false;
   });

   // Init tooltip
   //
   $('.tt').tooltip();

   // Init datepicker
   //
   $.datepicker.setDefaults({
       dateFormat: "dd/mm/yy"
   });

   $(".datepicker" ).datepicker();


   // Handle when hover on active button
   //
   $('.btn-active-action')
      .hover(toggleStyleEditBtn, toggleStyleEditBtn)
      .click(function(e) {
         e.preventDefault();
         var $this = $(this);
         $.ajax({
            url : $this.attr('href'),
            type : 'GET',
            dataType : 'json',
            success : function(data) {
               if(data.code === 1) {
                  var _btn = $this.find('i');
                  if(data.status == 1) {
                     $this.html('<i class="fa fa-check-square"></i>');
                  }else{
                     $this.html('<i class="fa fa-square-o"></i>');
                  }
               }else{
                  alert(data.message);
               }
            }
         })
      });


   $('.group-item').click(function() {
      var _href = $(this).data('href');
      var _newGroup = $(this).data('new');
      var _userType = $(this).data('type');
      if (_newGroup == 1 && _userType == 1) {
         alert("Bạn cần nâng cấp tài khoản để sử dụng chức năng này!");
         return false;
      } else {
         location.href = _href;
      }
   });
});

/**
 * Hàm thay đổi style class cho nút active
 */
function toggleStyleEditBtn () {
   var _btn = $(this).find('i');
   if (_btn.hasClass('fa-check-square')) {
      _btn.removeClass('fa-check-square').addClass('fa-square-o');
   } else {
      _btn.removeClass('fa-square-o').addClass('fa-check-square');
   }
}

/**
 * Toggle setting sidebar
 */
function toggleSettingSidebar() {
	var menu = $('#sb-menu');
	menu.toggleClass('active');
	if (menu.hasClass('active')) {
		menu.animate({
			'right' : 0
		}, 300);
	} else {
		menu.animate({
			'right' : '-320px'
		}, 300);
	}
}

/**
 * Hàm format số về dạng phần nghìn
 * @param nStr
 * @returns {*}
 */
function addCommas(nStr){
   nStr += ''; x = nStr.split(','); x1 = x[0]; x2 = ""; x2 = x.length > 1 ? ',' + x[1] : ''; var rgx = /(\d+)(\d{3})/; while (rgx.test(x1)) { x1 = x1.replace(rgx, '$1' + ',' + '$2'); } return x1 + x2;
}

/**
 * Return template for auto suggestion
 */
function tmplAutoSuggest (data) {
	var _title = data.title;
	return '<p class="sg-result" data-url="' + data.slug + '" data-title="' + _title + '">' + _title + '</p>';
}

/**
 * Hàm xử lý việc add các bài viết liên quan
 */
function addLinkHandle() {
	var suggestItem = $('#related-suggestion').data('item-selected') || {id: 0, value: ''};
	if (suggestItem.id > 0 ) {
		if (relatedLinks.indexOf(suggestItem.id) === -1) {
			var li = $('<li/>');
			li.html(suggestItem.value + ' <i class="fa fa-close text-danger" onclick="removeSeriesItem(this, \''+ suggestItem.id +'\')"></i>');
			$('#addition-link').append(li);
			relatedLinks.push(suggestItem.id);

			// assign to input control
			$('#addition-links').val(relatedLinks.join(','));
		} else {
			alert('Bài viết đã được thêm!');
		}
	} else {
		alert('Không có bài viết được chọn!');
	}

	// Clear text
	$('#related-suggestion').val('');
}


/**
 * Xóa item trong series
 */
function removeSeriesItem(obj, id) {
	var index = relatedLinks.indexOf(id);
	if(index > -1) {
		$(obj).parent('li').remove();
		relatedLinks.splice(index, 1);
	}

	$('#addition-links').val(relatedLinks.join(','));
}

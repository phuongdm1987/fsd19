function addCommas(nStr){
	nStr += ''; x = nStr.split(',');	x1 = x[0]; x2 = ""; x2 = x.length > 1 ? ',' + x[1] : ''; var rgx = /(\d+)(\d{3})/; while (rgx.test(x1)) { x1 = x1.replace(rgx, '$1' + ',' + '$2'); } return x1 + x2;
}

function getYoutubeIdFromUrl(url) {
	var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
	var match = url.match(regExp);
	if (match&&match[7].length==11){
	  	return match[7];
	}

	return false;
}

function escapeRegExp(str) {
   return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/, "\\$1");
}

function replaceAll(str, find, replace) {
  	return str.replace(new RegExp(escapeRegExp(find)), replace);
}

String.prototype.replaceAll = function (find, replace) {
	var str = this;
	return str.replace(new RegExp(find.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'), 'g'), replace);
};


function scrollToElement($selector, callback) {
	$('html, body').animate({
     	scrollTop: $selector.offset().top
 	}, 500, callback);
}


var Recommend = function(postId, token) {
	this.postId = postId;
	this.token  = token;
}

Recommend.prototype.setPostId = function(postId) {
	this.postId = postId;
}

Recommend.prototype.setToken = function(token) {
	this.token = token;
}

Recommend.prototype.getDataToSendRequest = function() {
	var self = this;
	return {
		post_id : self.postId,
		_token : self.token,
		url : window.location.href
	}
};

Recommend.prototype.addRecommendPost = function() {
	var self = this;

	return $.ajax({
		url : '/ajax/add-recommend-post',
		type : 'POST',
		dataType : 'json',
		data : self.getDataToSendRequest()
	});
};
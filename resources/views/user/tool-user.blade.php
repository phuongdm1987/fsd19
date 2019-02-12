<section class="fsd-box right-box">
	<h4 class="text-center">Công cụ</h4>
	<section class="box-controls text-center">
		@if($user->follows)
			<div
					data-followstatus="follower"
					data-token="{{csrf_token()}}"
					data-urlreturn="{{base64_encode(url()->current())}}"
					data-uid="{{$user->id}}"
					class="btn btn-xs js-btn-follow btn-follow-cc unfollow js-btn-follow {{auth()->check() && $user->id !== auth()->id() ? 'btn-info' : 'btn-danger'}}"><i class="fa fa-user-plus"></i> Unfollow</div>
		@else
			<div data-followstatus="notfollow" data-token="{{csrf_token()}}" data-urlreturn="{{base64_encode(url()->current())}}" data-uid="{{$user->id}}" class="btn btn-xs js-btn-follow btn-follow-cc follow js-btn-follow"><i class="fa fa-user-plus"></i> Follow</div>
		@endif
		<p class="clearfix"></p>
		<ul class="list-inline">
			<li>
				<a
						href="{{$user->getFollowPageUrl('followers')}}"
						class="link-title"> {{$user->followers->count()}} Follow</a>
			<li>
			<li>
				<a
						href="{{$user->getFollowPageUrl('following')}}"
						class="link-title"> {{$user->followings->count()}} Following</a>
			<li>
		</ul>
	</section>
</section>

@extends('layouts/user')

@section('content')
	@if($list_user_follower->isEmpty())
		<p class="text-center">Chưa có theo dõi nào</p>
	@else
		<h2 class="text-center">{{ $follow == 'followers' ? 'Theo dõi ' . count($list_object_user) .' người' : count($list_object_user). ' người đang theo dõi'}}</h2>
		<hr/>
		@foreach ($list_object_user as $key => $object_user)
			@foreach ($list_user_follower[$object_user->id] as $key => $follower)
				<section class="follower-item col-sm-4 col-md-4">
					<section class="fsd-box">
						<div class="fsd-photo-author">
							<a href="{{ $follower->getHomePageUrl() }}" class="author-cover" style="background-image: url('{{ $follower->getCover() }}');"></a>
							<a href="{{ $follower->getHomePageUrl() }}" class="author-avatar" style="background: url({{ $follower->gravatar('large_') }}) no-repeat center center #fff; background-size: cover;"></a>
							@if(Sentry::check() && $user->id == Sentry::getUser()->getId())
								@if($follower->id != Sentry::getUser()->getId())
									{{ Follower::createButtonFollow($follower, 'btn-info js-btn-follow') }}
								@else
									{{ Follower::createButtonFollow($follower, 'btn-danger js-btn-follow') }}
								@endif
							@elseif(Sentry::check() && $user->id != Sentry::getUser()->getId())
								{{ Follower::createButtonFollow($user, 'btn-danger js-btn-follow') }}
							@else
								{{ Follower::createButtonFollow($user, 'btn-danger js-btn-follow') }}
							@endif
						</div>
						<div class="fsd-content-author">
							<h3 class="title-author"><a href="{{ $follower->getHomePageUrl() }}" title="{{ $follower->nickname }}" class="link-title author-name">{{ $follower->nickname }}</a></h3>
							<p class="author-hobbies">{{ $follower->hobbies }}</p>
						</div>
					</section>
				</section>
			@endforeach
		@endforeach
		<p class="clearfix"></p>
		<section class="fsd-pagination">
			{{ $list_object_user->appends(Input::all())->links() }}
		</section>
	@endif
@stop

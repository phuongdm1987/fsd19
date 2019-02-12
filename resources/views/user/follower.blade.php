@extends('layouts/user')

@section('content')
	@if($list_user_follower->isEmpty())
		<p class="text-center">Chưa có theo dõi nào</p>
	@else
		<h2 class="text-center">{{ $follow === 'followers' ? 'Theo dõi ' . count($list_user_follower) .' người' : count($list_user_follower). ' người đang theo dõi'}}</h2>
		<hr/>
		@foreach ($list_user_follower as $key => $follower)
			<section class="follower-item col-sm-4 col-md-4">
				<section class="fsd-box">
					<div class="fsd-photo-author">
						<a href="{{ $follower->getHomePageUrl() }}" class="author-cover" style="background-image: url('{{ $follower->getCover() }}');"></a>
						<a href="{{ $follower->getHomePageUrl() }}" class="author-avatar" style="background: url({{ $follower->gravatar() }}) no-repeat center center #fff; background-size: cover;"></a>
						@if(auth()->check() && $user->id === auth()->id())
							{!! Henry\Support\Follower::createButtonFollow($follower) !!}
						@else
							{!! Henry\Support\Follower::createButtonFollow($user) !!}
						@endif
					</div>
					<div class="fsd-content-author">
						<h3 class="title-author"><a href="{{ $follower->getHomePageUrl() }}" title="{{ $follower->nickname }}" class="link-title author-name">{{ $follower->nickname }}</a></h3>
						<p class="author-hobbies">{!! $follower->hobbies !!}</p>
					</div>
				</section>
			</section>
		@endforeach
		<p class="clearfix"></p>
		<section class="fsd-pagination">
			{{ $list_user_follower->appends(request()->all())->links() }}
		</section>
	@endif
@stop

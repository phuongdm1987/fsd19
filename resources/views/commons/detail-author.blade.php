@section('left_sidebar')
	<section class="side-item">
		<h3>Đăng bởi</h3>
		<section class="fsd-box">
			<div class="author-avatar text-center" style="background: url({{ $post->author->getCover() }})">
				<a href="{{ $post->author->getHomePageUrl() }}" title="{{ $post->author->username }}" style="background: url({{ $post->author->gravatar() }}) no-repeat center center #fff; background-size: cover; width: 80px; height: 80px; border-radius: 50%;"></a>
			</div>
		</section>
	</section>
@stop

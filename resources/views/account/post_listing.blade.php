@extends('layouts.account')

{{-- Account page content --}}
@section('content')
	<section class="container-fluid">
		<section id="listing-post-blk">
			<section class="pl">
				<section class="post-head">
					<span class="pd-l-10">Danh sách bài viết</span>
					<a href="{{ route('account.posts.create') }}" class="pull-right btn btn-success btn-xs btn-new-post"><i class="fa fa-plus"></i></a>
				</section>
				<ul id="filter-post" class="list-unstyled">
					<li><a href="{{ URL::current() }}?active=1" class="{{ request('active', 1) == 1 ? '' : 'deactive' }}">Xuất bản</a></li>
					<li><a href="{{ URL::current() }}?active=0" class="{{ request('active', 1) == 0 ? '' : 'deactive' }}">Bản nháp</a></li>
				</ul>
				<ul id="listing-post" class="list-unstyled">
					@if (count($posts) > 0)
						@foreach ($posts as $k => $post)
							<li {{ ($current_post->id === $post->id) ? 'class="active"' : '' }} >
								<a href="{{ route('account.posts.show', $post->id) }}?active={{request('active', 1)}}" title="{{ $post->title }}">
									<h3>{{ $post->title }}</h3>
									<p style="font-size: 13px">{{ $post->active === 0 ? 'Bản nháp' : ('Đăng lúc: ' . $post->created_at->format('H:i - d/m/Y') . '<br/>Cập nhật: ' . $post->updated_at->format('H:i d/m/Y')) }}</p>
								</a>
							</li>
						@endforeach
					@else
						<li class="pd-t-10 pd-l-15">Bạn hiện chưa có bài viết.</li>
					@endif
				</ul>

				{{ $posts->appends(request()->all())->links() }}
			</section>
			<section class="pc">
				@if ($current_post)
					<section class="post-head">
						<span>Được viết bởi <a href="{{ $current_post->author->getHomePageUrl() }}" target="_blank">{{ $current_post->author->nickname }}</span>
						<a href="{{ $current_post->url() }}" class="btn btn-xs pull-right btn-default mg-l-5" target="_blank"><i class="fa fa-eye"></i> Xem</a>
						<a href="{{ route('account.posts.delete', $current_post->id) }}" class="btn btn-xs pull-right btn-danger btn-delete-action mg-l-5"><i class="fa fa-trash-o"></i> Xóa</a>
						<a href="{{ route('account.posts.edit', $current_post->id) }}" class="btn btn-xs pull-right btn-primary"><i class="fa fa-pencil"></i> Sửa</a>
					</section>
					<section id="listing-post-content">
						{!! $current_post->content !!}
					</section>
				@else
					<section class="post-head">
						<span>Nội dung</span>
					</section>
					<section id="listing-post-content">Chưa có nội dung</section>
				@endif
			</section>
		</section>
	</section>
@stop

@section('scripts')
	<script>
		$(function() {
			var plHeight = $(".pl", "#listing-post-blk").height();
			var pcHeight = $(".pc", "#listing-post-blk").height();

			if (plHeight > pcHeight) {
				$(".pc", "#listing-post-blk").height(plHeight);
			} else {
				$(".pl", "#listing-post-blk").height(pcHeight);
			}
		});
	</script>
@stop

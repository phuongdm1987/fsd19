@extends('layouts/default')
@section('styles')
   @foreach ($post->relationTags as $tag)
       <meta property="article:tag" content="{{ $tag->name }}" />
   @endforeach
   <meta property="article:section" content="{{ $post->category ? $post->category->name : '' }}" />
   <meta property="article:author" content="{{ $post->author->username }}" />
   <meta property="article:published_time" content="{{ $post->created_at }}" />
   <meta property="og:author" content="{{ $post->author->username }}" />
   <meta property="og:image" content="{{ url()->current() . $post->thumbnail }}" />
   <link href="{{ secure_asset('css/prettify.css') }}" rel="stylesheet">
@stop

@section('left_sidebar')
	@include('commons/detail-author')
@stop

@section('content')
	@include('commons/breadcrumb')
	<h1 class="title-post">{{ $post->title }}</h1>
	<p>
		Đăng lúc {{ $post->publishTimes() }} - {{ $post->views }} views
	</p>
	<section id="detail-post">
		{!! $post->content !!}

        <section class="post-summary">
            <h3>Fsd14</h3>
            <p>
                Bài viết được đăng trên blog <a href="https://fsd19.com" title="fsd14">Fsd14</a>,
                các bạn có thể copy về blog của mình hoặc share bất kỳ đâu nhưng
                vui lòng ghi rõ nguồn về blog fsd14 như một sự tôn trọng công sức biên soạn và dịch bài của tác giả. Cảm ơn các bạn!
            </p>
        </section>
        @if($post->org_link !== '' && $post->org_author !== '')
            <blockquote><p>Nguồn bài viết <a href="{{$post->org_link}}" rel="nofollow">{{$post->org_author}}</a>.</p></blockquote>
        @endif

        @if($post->relationTags)
            <p class="tag-post">
                <strong><i class="fa fa-tags"></i> Tags</strong>:
                {!! $post->getTags() !!}
            </p>
        @endif

      <div class="">
         <div class="pull-left"><button id="btn-recommend" data-post="{{ $post->id }}" data-token="{{ csrf_token() }}" class="pdetail-btn-recommend fsd-btn-recommend"><i class="fa {{ $post->isFavorite() ? 'fa-heart fsd-heart' : 'fa-heart-o' }}"></i> Recommend</button></div>
         <div class="fb-like" data-href="{{ Request::url() }}" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
      </div>

		@if($relatedPosts)
            <hr><h3>Tham khảo thêm các bài viết sau:</h3>
            <ul class="related-posts">
                @foreach($relatedPosts as $relatedPost)
                    <li><a href="{{$relatedPost->url()}}" title="{{$relatedPost->title}}">{{$relatedPost->title}}</a></li>
                @endforeach
            </ul>
        @endif

		<hr/>
		<section class="disqus">
         <div id="disqus_thread"></div>
      </section>
	</section>
@stop

@section('right_sidebar')
	@include('commons.top-recommenced')
@stop

@section('scripts')
	<script src="{{ secure_asset('js/prettify.js') }}" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
      $(function() {
          var d = document, s = d.createElement('script');
          s.src = 'https://fsd19.disqus.com/embed.js';
          s.setAttribute('data-timestamp', +new Date());
          (d.head || d.body).appendChild(s);

         prettyPrint();
      });
	</script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
   <script src="{{ secure_asset('js/follower.js') }}" type="text/javascript"></script>
@stop

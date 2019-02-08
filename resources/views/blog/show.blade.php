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
   <link href="{{ asset('css/prettify.css') }}" rel="stylesheet">
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
                Bài viết được đăng trên blog <a href="http://fsd19.com" title="fsd14">Fsd14</a>,
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
      <div class="fsd-box">
         <iframe width="694" height="200" src="http://lap.lazada.com/banner/dynamic.php?banner_id=57105989dbd78&theme=1&p=1" frameborder="0" scrolling="no"></iframe>
      </div>

		@if($relatedPosts)
            <hr><h3>Tham khảo thêm các bài viết sau:</h3>
            <ul class="related-posts">
                @foreach($relatedPosts as $relatedPost)
                    <li><a href="{{$relatedPost->url()}}" title="{{$post->title}}">{{$post->title}}</a></li>
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
	<script src="{{ asset('js/prettify.js') }}" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
	   /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
      var disqus_shortname = 'fsd14'; // required: replace example with your forum shortname

      /* * * DON'T EDIT BELOW THIS LINE * * */
      (function() {
      var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
      dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
      (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
      })();
      // facebook
      (function(d, s, id) {
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) return;
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
         fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

		$(function() {
         prettyPrint();
      });
	</script>
   <script src="{{ asset('js/follower.js') }}" type="text/javascript"></script>
@stop

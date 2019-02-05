@if ($type != '' && $type != 'user' && $type != 'category')
	<section class="fsd-box rs-filter">
		<h1>Tìm kiếm với {{ $type }} <strong class="red">{{ $value_type }}</strong> <small>(có {{ $posts->getTotal() }} bài viết)</small></h1>
	</section>
@endif
@forelse ($posts as $ind => $p)
    <section class="fsd-box main-item">
        <section class="main-head">
            <a href="{{ $p->author->getHomePageUrl() }}" title="{{ $p->author->nickname }}" class="author-block pull-left img-circle" style="background: url({{ $p->author->gravatar('medium_') }}) no-repeat center center;background-size: cover; width: 40px;height: 40px; display: block"></a>
            <div class="post-info-head">
                <a href="{{ $p->author->getHomePageUrl() }}" title="{{ $p->author->nickname }}" class="link-title">{{ $p->author->nickname }}</a><br>
                <span class="text-muted"><i class="fa fa-clock-o"></i> {{ $p->publishTimes() }}</span> - <span class="text-muted">{{ $p->views }} views</span>
            </div>
            @if(is_object($p->category))
            <a href="{{ $p->category->url() }}" class="link-title category-post"><i class="fa fa-folder-open-o"></i> {{ $p->category->name }}</a>
            @endif
        </section>
        <section class="main-body">
            <a href="{{ $p->url() }}" title="{{ $p->title }}" class="img-post hidden-xs" style="background: url({{ $p->thumbnail('large_') }}) no-repeat center center;background-size: cover">{{ $p->title }}</a>
            <a href="{{ $p->url() }}" title="{{ $p->title }}" class="img-post visible-xs">
                <img src="{{ $p->thumbnail('medium_') }}">
            </a>
            <section class="info-post">
                <h3 class="title-post"><a href="{{ $p->url() }}" title="{{ $p->title }}" class="link-title">{{ $p->title }}</a></h3>
                <p class="teaser-post">
                    {{ Str::words(strip_tags($p->content), 60) }}
                </p>
                <p class="tag-post">
                    {{ $p->getTags() != "" ? '<strong><i class="fa fa-tags"></i> Tags</strong>:' . $p->getTags() : "" }}
                </p>
            </section>
        </section>

        <section class="main-bot">
            <button class="btn btn-recommend btn-sm pull-left fsd-btn-recommend" data-token="{{ csrf_token() }}" data-post="{{ $p->id }}"><i class="fa {{ isset($recommends[$p->id]) ? 'fa-heart fsd-heart' : 'fa-heart-o' }}"></i> Recommend</button>
            <p class="clearfix"></p>
        </section>
    </section>

	<section class="fsd-pagination">
		{{ $posts->appends(Input::all())->links() }}
	</section>
@empty
	<section class="fsd-box rs-filter">
		<h4>Không tìm thấy bài viết!</h4>
	</section>
@endforelse

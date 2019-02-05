<section class="fsd-box right-box">
    <i class="fa fa-heart recommend-active"></i>
    <h4 class="text-center">Bài viết nổi bật</h4>
    <ul class="list-unstyled top-recommend-box">
        @foreach($topPosts as $pIndex => $top)
            <li>
                <div class="recommend-post-item">
                    <span class="rank-post">{{ $pIndex + 1 }}</span>
                    <a href="{{ $top->category->url() }}" title="{{ $top->category->name }}" class="tr-cate link-title">{{ $top->category->name }}</a>
                    <div class="trb-title"><a href="{{ $top->url() }}" class="link-title tr-title" title="{{ $top->title }}">{{ str_limit(strip_tags($top->title), 7) }}</a></div>
                    <span class="text-muted"><i class="fa fa-clock-o"></i> {{ $top->publishTimes() }}</span>
                    <i class="fa fa-angle-right"></i>
                </div>
            </li>
        @endforeach
    </ul>
</section>

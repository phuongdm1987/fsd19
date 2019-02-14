<section id="sb-menu">
	<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <h4>Thông tin thêm</h4>
   <hr/>
	<div class="related-post-group">
      <b class="sb-setting-title text-danger">Hẹn giờ</b>
      <div class="form-group">
         <input type="text" name="date-timer" class="form-control date-timer" form="new-post">
      </div>
		<b class="sb-setting-title text-danger">Nguồn bài viết</b>
		<div class="form-group">
			<label for="author">Tên tác giả</label>
			<input type="text" name="author" id="author" form="new-post" class="form-control" placeholder="Tên tác giả" value="{{ old('author', isset($post) ? $post->org_author : '') }}" />
      </div>

		<div class="form-group">
			<label for="link">Link gốc</label>
			<input type="text" name="link" id="link" form="new-post" class="form-control" placeholder="Link" value="{{ old('link', isset($post) ? $post->org_link : '') }}"/>
		</div>

		<b class="sb-setting-title text-danger">Series</b>
		<div class="form-group">
         <label for="related-suggestion">Tiêu đề hoặc link</label>
         <input type="text" id="related-suggestion" class="form-control typeahead" placeholder="Nhập tiêu đề hoặc link"/>
         <input type="hidden" name="addition_links" id="addition-links" form="new-post" value="{{ old('addition_links', isset($post) ? $post->related_post : '') }}"/>
         <ul id="addition-link">
         @if (isset($related_posts))
            @foreach($related_posts as $rp)
               <li>{{ $rp->title }} <i class="fa fa-close text-danger" onclick="removeSeriesItem(this, '{{ $rp->id }}')"></i></li>
            @endforeach
         @endif
         </ul>
      </div>
	</div>
</section>

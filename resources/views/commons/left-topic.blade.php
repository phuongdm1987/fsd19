<section class="side-item">
	<h3>Chủ đề nóng</h3>
	<section class="fsd-box taglists">
		@foreach($tags as $tag)
			<a href="/tag/{{ $tag->slug }}" title="{{ $tag->name }}">{{ $tag->name }}</a>
		@endforeach
		<p class="clearfix"></p>
		<p class="intro">Bạn sẽ dễ dàng tìm được chủ đề đang được quan tâm nhất trên hệ thống FSD14 thông qua các tags.</p>
	</section>
</section>

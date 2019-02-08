<ul class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
	<li typeof="v:Breadcrumb">Quay lại: <a rel="v:url" property="v:title" href="/" title="Trang chủ">Trang chủ</a></li>
	@foreach ($breadcrumbs as $breadcrumb)
		<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="{{ $breadcrumb->url() }}" title="{{ $breadcrumb->name }}">{{ $breadcrumb->name }}</a></li>
	@endforeach
</ul>

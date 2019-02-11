@extends('layouts/default')

@section('left_sidebar')
	@include('commons.left-topic')
@stop

@section('content')
	@if($type === 'category')
		<section class="fsd-box rs-filter">
			@include('commons.breadcrumb')
		</section>
	@endif
	@if($category->id !== 3)
		@include('commons.listing')
	@endif
@stop

@section('right_sidebar')
	@include('commons.top-recommenced')
@stop

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
	@include('commons.listing')
@stop

@section('right_sidebar')
	@include('commons.top-recommenced')
@stop

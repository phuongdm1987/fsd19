@extends('layouts/default')
@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/user-wall.css') }}">
@stop

@section('content')
	@include('commons.listing')
@stop

@section('right_sidebar')
	@include('user.tool-user')
@stop
@section('scripts')
	<script src="{{ asset('js/jquery.ui.widget.js') }}"></script>
  	<script src="{{ asset('js/jquery.fileupload.js') }}"></script>
  	<script src="{{ asset('js/jquery.bootstrap-growl.min.js') }}"  type="text/javascript"></script>
	<script src="{{ asset('js/user-wall.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/follower.js') }}" type="text/javascript"></script>
@stop

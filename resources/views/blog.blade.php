@extends('layouts/default')

@section('left_sidebar')
    @include('commons/left-topic')
@endsection

@section('content')
    @include('commons.listing')
@endsection

@section('right_sidebar')
    @include('frontend/includes/top-recommenced')
@endsection

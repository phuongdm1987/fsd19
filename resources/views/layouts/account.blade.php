<!DOCTYPE html>
<html lang="en">
	<head>
		<title>{{ $metadata->getFullTitle() }} </title>
      <meta name="keywords" content="{{ $metadata->getKeywords() }}"/>
      <meta name="description" content="{{ $metadata->getDescription() }}"/>
      <meta name="author" content="{{ $metadata->getOwner() }}"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/ui.css') }}" rel="stylesheet">
      <link href="{{ asset('css/common.css') }}" rel="stylesheet">
      <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
      @yield('styles')

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<link rel="shortcut icon" href="{{ asset('ico/favicon.png') }}">
	</head>

	<body>
      <header class="header">
         <ul class="list-unstyled">
            <li><a href="/" class="logo" target="_blank">FSD14</a></li>
            <li><a href="{{ route('account.index') }}"><i class="fa fa-list-alt"></i> Danh sách</a></li>
            <li><a href="{{ route('account.posts.create') }}"><i class="fa fa-pencil"></i> Viết bài</a></li>
            <li><a href="{{ route('account.show') }}"><i class="fa fa-gears"></i> Cài đặt</a></li>
         </ul>
         <a class="p-act-h pull-right pd-r-20" href="{{ route('logout.get') }}"><i class="fa fa-sign-out"></i> Thoát</a>
         <a class="p-act-h pull-right pd-r-20" href="{{ auth()->user()->getHomePageUrl() }}"><i class="fa fa-home"></i> Trang chủ</a>
      </header>
      <section id="wrapper">
         <section id="account-content">
            <section class="container">
               @include('commons.notifications')
               @if (Request::is('account/posts/create') || Request::is('account/posts/*/edit'))
                  @include('account.sidebar')
               @endif
               @yield('content')
            </section>
         </section>
      </section>

		<!-- Javascripts
		================================================== -->
      <script src="{{ asset('js/jquery.1.10.2.min.js') }}"></script>
      <script src="{{ asset('js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('js/ui_datepicker.js') }}"></script>
      <script src="{{ asset('js/sugar.min.js') }}"></script>
      <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
      <script src="{{ asset('js/profile.js') }}"></script>
      @yield('scripts')
	</body>
</html>

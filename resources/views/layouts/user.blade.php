<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>{{ $metadata->getFullTitle() }}</title>
	<meta name="google-site-verification" content="T5QmFLMRpWm-OTKvHchxN-KDNZAvycihstvSB2rvS-M" />
	<meta name="keywords" content="{{ $metadata->getKeywords() }}"/>
	<meta name="description" content="{{ $metadata->getDescription() }}"/>
	<meta name="author" content="{{ $metadata->getOwner() }}"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="canonical" href="{{ URL::current() }}" />
	<meta itemprop="name" content="{{ $metadata->getFullTitle() }}">
	<meta itemprop="description" content="{{ $metadata->getDescription() }}">
	<meta property="og:locale" content="vi_VN" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="{{ $metadata->getFullTitle() }}" />
	<meta property="og:description" content="{{ $metadata->getDescription() }}" />
	<meta property="og:site_name" content="{{ $metadata->getOwner() }}" />
	<meta property="og:url" content="{{ URL::current() }}" />
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@VNFsd14">
	<meta name="twitter:title" content="{{ $metadata->getFullTitle() }}">
	<meta name="twitter:description" content="{{ $metadata->getDescription() }}">
	<meta name="twitter:creator" content="@fsd14">
	<link rel="icon" href="{{ asset('ico/favicon16.gif') }}" type="image/gif" sizes="16x16">
	<link rel="icon" href="{{ asset('ico/favicon32.gif') }}" type="image/gif" sizes="32x32">

	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/jquery.sidr.light.css') }}" rel="stylesheet">
	<link href="{{ asset('css/common.css') }}" rel="stylesheet">
	<link href="{{ asset('css/fsd14.css') }}" rel="stylesheet">
	<link href="{{ asset('css/fsd_14.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/user-wall.css') }}">
	<!-- Custom Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	@yield('styles')

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body class="{{ Request::is('post/*') ? 'bg-white' : '' }}" data-token="{{ csrf_token() }}" data-logging="{{ auth()->check() ? 'true' : 'false' }}">
	<section id="event-comming">
		@include ('layouts.event')
	</section>
    <form action="{{route('quickSearch')}}" class="form-inline search-form hidden-xs hidden-md" id="search-form-top">
        <div>
            <i class="fa fa-search"></i>
            <input type="text" name="q" class="form-control" placeholder="Tìm kiếm mọi thứ...">
        </div>
    </form>

	<!-- Navigation -->
	@include('commons.navigation')

	@if($type === 'user')
		@include('user.header-wall')
	@endif

	<section id="content" class="container">
		<!-- Main content -->
		<section class="main-side row">
			@include('commons.notifications')
			<!-- Content -->
			@yield('content')
		</section>
	</section>

	<footer id="footer">
		<div class="container">
			<div class="row text-center">
				<div class="col-md-12">
					<h4 class="copyright">Viet Nam Full-stack developer &copy; {{ date('Y')}}</h4>
				</div>
				<div class="col-md-12">
					<p>Đăng ký nhận bản tin miễn phí</p>
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					@if (session('success'))
						<p class="text-success mg-bt-0 mg-t-5"><small>{{ session('success') }}</small></p>
					@endif
					<form class="form-inline" method="POST" id="subscribe-form" action="{{ route('subscribes.subscribe') }}#subscribe-form">
						<div class="form-group">
							{{csrf_field()}}
							<input type="email" class="form-control input-md" id="email" name="email" placeholder="vnfsd14@gmail.com" required>
						</div>
						<button type="submit" id="btn-subscribe" class="btn btn-danger btn-md">Subscribe</button>
					</form>
					<p class="text-note">Chúng tôi sẽ không spam bạn, bạn có thể unsubscribe bất cứ lúc nào.</p>
					<ul class="list-inline social-buttons">
						<li><a href="https://twitter.com/VNFSD" class="btn btn-link" target="_blank"><i class="fa fa-twitter"></i></a>
						</li>
						<li><a href="https://www.facebook.com/vnfsd" class="btn btn-link" target="_blank"><i class="fa fa-facebook"></i></a>
						</li>
						<li><a href="https://plus.google.com/u/0/communities/103694226235937430493" class="btn btn-link" target="_blank"><i class="fa fa-google"></i></a>
						</li>
						<li><a href="{{ route('rss.index') }}" class="btn btn-link" target="_blank"><i class="fa fa-rss"></i></a>
						</li>
					</ul>
				</div>
				<div class="col-md-12">
					<ul class="list-inline quicklinks">
						<li><a href="#">Giới thiệu</a>
						</li>
						<li><a href="#">Quy định sử dụng</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/functions.js') }}"></script>
	<script src="{{ asset('js/jquery.tokeninput.js') }}"></script>
	<script src="{{ asset('js/prettify.js') }}"></script>
	{{-- <script src="{{ asset('js/bootbox.js') }}"></script> --}}
	<script src="{{ asset('js/jquery.plugin.min.js') }}"></script>
	<script src="{{ asset('js/jquery.sidr.min.js') }}"></script>
	<script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
	<!--JS For Page User-->
	<script src="{{ asset('js/jquery.ui.widget.js') }}"></script>
  	<script src="{{ asset('js/jquery.fileupload.js') }}"></script>
  	<script src="{{ asset('js/jquery.bootstrap-growl.min.js') }}"></script>
	<script src="{{ asset('js/user-wall.js') }}"></script>
	<script src="{{ asset('js/follower.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
	@yield('scripts')
</body>
</html>

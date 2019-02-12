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
    <meta itemprop="name" content="{{ $metadata->getFullTitle() }}">
    <meta itemprop="description" content="{{ $metadata->getDescription() }}">
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $metadata->getFullTitle() }}" />
    <meta property="og:description" content="{{ $metadata->getDescription() }}" />
    <meta property="og:site_name" content="{{ $metadata->getOwner() }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@VNFSD ">
    <meta name="twitter:title" content="{{ $metadata->getFullTitle() }}">
    <meta name="twitter:description" content="{{ $metadata->getDescription() }}">
    <meta name="twitter:creator" content="@fsd14">
    <link rel="icon" href="{{ asset('ico/favicon16.gif') }}" type="image/gif" sizes="16x16">
    <link rel="icon" href="{{ asset('ico/favicon32.gif') }}" type="image/gif" sizes="32x32">

    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/jquery.sidr.light.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fsd14.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fsd_14.css') }}" rel="stylesheet">

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

<body class="{{ Request::is('post/*') ? 'bg-white' : '' }}">
<form action="{{route('quickSearch')}}" method="get" id="search-form-top" class="form-inline search-form hidden-xs hidden-md">
    <div>
        <i class="fa fa-search"></i>
        <input type="text" name="q" id="q" value="{{request('q', '')}}" class="form-control" placeholder="Tìm kiếm mọi thứ...">
    </div>
</form>

<!-- Navigation -->
@include('commons/navigation')

@if($type === 'user')
    @include('user.header-wall')
@endif

<section id="content" class="container">

<!-- Main content -->
    <section class="main-side col-sm-9">
    @include('commons/notifications')
    <!-- Content -->
        @yield('content')
    </section>

    <!-- Right sidebar -->
    <section class="right-side col-sm-3">
        @yield('right_sidebar')
    </section>
</section>

<footer id="footer">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="copyright">Viet Nam Full-stack developer &copy; {{date('Y')}}</div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="scrollToTop"><i class="fa fa-angle-up fa-2x"></i></a>
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/prettify.js') }}"></script>
<script src="{{ asset('js/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('js/jquery.sidr.min.js') }}"></script>
<script src="{{ asset('js/app14.js') }}"></script>
<script src="{{ asset('js/recommend.js') }}"></script>
<script src="{{ asset('js/recommend.handler.js') }}"></script>
@yield('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>{{ $metadata->getFullTitle() }} </title>
      <meta name="keywords" content="{{ $metadata->getKeywords() }}"/>
      <meta name="description" content="{{ $metadata->getDescription() }}"/>
      <meta name="author" content="{{ $metadata->getOwner() }}"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link href="{{ secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ secure_asset('css/bootstrap-social.css') }}" rel="stylesheet">
      <link href="{{ secure_asset('css/font-awesome.min.css') }}" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
      <link href="{{ secure_asset('css/common.css') }}" rel="stylesheet">
      <link href="{{ secure_asset('css/auth.css') }}" rel="stylesheet">
      @yield('styles')

      <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->

      <link rel="icon" href="{{ secure_asset('ico/favicon16.gif') }}" type="image/gif" sizes="16x16">
      <link rel="icon" href="{{ secure_asset('ico/favicon32.gif') }}" type="image/gif" sizes="32x32">
   </head>

   <body>
      <!-- Container -->
      <section class="container" id="auth-wrapper">
         <!-- Content -->
         @yield('content')
      </section>

      <!-- Javascripts
      ================================================== -->
   </section>
      <script src="{{ secure_asset('js/jquery.1.10.2.min.js') }}"></script>
      <script src="{{ secure_asset('js/bootstrap.min.js') }}"></script>
      @yield('scripts')
   </body>
</html>

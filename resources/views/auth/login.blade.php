@extends('layouts/auth')

{{-- Page title --}}
@section('title')
    Đăng nhập ::
    @parent
@stop

@section('styles')
    <style>
        body {
            background-color: #f2f2f2;
            width: 100%;
            height: 100%;
        }
    </style>
@stop

@section('content')

    <form action="" method="POST" autocomplete="off" role="form">
        <section class="col-sm-4 col-sm-offset-4" id="login-container">
            <!-- Notifications -->
            @include('commons/notifications')

            <section id="login-logo">
                <a href="/" title="{{ $metadata->getOwner() }}">{{ $metadata->getOwner() }}</a> . Being a full-stack developer
            </section>

            <section class="form-group" id="signup-intro">
                <h3>Đăng nhập</h3>
            </section>

            @if (isset($error))
                <p>{{ $error }}</p>
        @endif

        <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <section class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">Email {{ $errors->first('email', '<span class="help-inline text-danger">:message</span>') }}</label>
                <input type="text" class="form-control" name="email" id="email" autofocus value="{{ old('email') }}">
            </section>

            <section class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">Mật khẩu {{ $errors->first('password', '<span class="help-inline text-danger">:message</span>') }}</label>
                <input type="password" class="form-control" name="password" id="password">
            </section>

            <section class="form-group">
                <label for="remember-me" class="checkbox">
                    <input type="checkbox" name="remember" id="remember-me"> Giữ đăng nhập
                </label>
            </section>

            <section class="form-group text-center">
                <input type="submit" class="btn btn-danger btn-sm" value="Đăng nhập">
                <a href="/" class="btn btn-default btn-sm">Trở lại</a>
            </section>

            <section class="form-group">
                <label for="remember-me" class="head_oath">
                    Hoặc đăng nhập bằng:
                </label>
            </section>

            <section class="form-group text-center">
                <a class="btn btn-social btn-facebook" href="/auth/facebook">
                    <i class="fa fa-facebook"></i> Facebook
                </a>
                <a class="btn btn-social btn-google" href="/auth/google">
                    <i class="fa fa-google"></i> Google
                </a>
                <a class="btn btn-social btn-github" href="/auth/github">
                    <i class="fa fa-github"></i> Github
                </a>
            </section>

        </section>
        <p class="clearfix"></p>
        <section class="col-sm-4 col-sm-offset-4 text-center">
            <a href="{{ route('register') }}" class="btn btn-link" title="Tạo tài khoản mới">Tạo tài khoản mới</a> .
            <a href="{{ route('password.request') }}" class="btn btn-link" title="Quên mật khẩu">Quên mật khẩu?</a>
        </section>
        <p class="clearfix"></p>
        <section class="col-sm-4 col-sm-offset-4">
            <h1 class="footer-logo-text"><a href="/" title="{{ $metadata->getOwner() }}">{{ $metadata->getOwner() }}</a></h1>
            <p class="signup-footer">&copy; <?= date('Y') ?> {{ $metadata->getOwner() }}<sup>&reg;</sup> - Develop by <a style="color: #27ae60;" href="/">FSD.14</a>.</p>
        </section>
    </form>
@stop

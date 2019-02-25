@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
Đổi mật khẩu
@stop

{{-- Account page content --}}
@section('content')
<h1 class="head-title"><i class="glyphicon glyphicon-user"></i> Đổi mật khẩu</h1>

<form method="post" action="" class="form-horizontal" autocomplete="off">
   <!-- CSRF Token -->
   <input type="hidden" name="_token" value="{{ csrf_token() }}" />

   <!-- Old Password -->
   <section class="form-group {{ $errors->has('old_password') ? 'has-error' : '' }}">
      <label for="old_password" class="col-md-3 control-label">Mật khẩu hiện tại {{ $errors->first('old_password', '<span class="help-inline text-danger pull-right">:message</span>') }}</label>
      <div class="col-md-6">
         <input type="password" class="form-control" name="old_password" id="old_password" autofocus value="{{ Input::old('old_password') }}">
      </div>
   </section>

   <!-- New Password -->
   <section class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
      <label for="password" class="col-md-3 control-label">Mật khẩu mới {{ $errors->first('password', '<span class="help-inline text-danger pull-right">:message</span>') }}</label>
      <div class="col-md-6">
         <input type="password" class="form-control" name="password" id="password" value="{{ Input::old('password') }}">
      </div>
   </section>

   <!-- Confirm New Password  -->
   <section class="form-group {{ $errors->has('password_confirm') ? 'has-error' : '' }}">
      <label for="password_confirm" class="col-md-3 control-label">Xác nhận mật khẩu mới {{ $errors->first('password_confirm', '<span class="help-inline text-danger pull-right">:message</span>') }}</label>
      <div class="col-md-6">
         <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="{{ Input::old('password_confirm') }}">
      </div>
   </section>

   <!-- Form actions -->
   <div class="form-group">
      <div class="controls col-md-offset-3 col-md-6">
         <button type="submit" class="btn btn-danger">Cập nhật</button>
         <a href="{{ route('profile') }}" class="btn btn-link">Trở lại</a>
      </div>
   </div>
</form>
@stop

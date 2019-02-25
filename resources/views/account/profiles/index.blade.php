@extends('layouts.account')

{{-- Account page content --}}
@section('content')
<section class="profile-block">

	<!-- Profile -->
	<section class="col-sm-8">
		<h1 class="head-title"><i class="fa fa-user"></i> Thông tin cá nhân</h1>
		<form method="post" id="f-update-profile" action="{{route('account.updateProfile')}}" class="form-horizontal" autocomplete="off">
			{{csrf_field()}}
			@method('PUT')

			<section class="group-controls">
				<section class="form-group">
					<label for="last_name" class="col-md-3 control-label">Ảnh đại diện</label>
					<div class="col-md-8">
						<img src="http://gravatar.com/avatar/{{ md5($user->email) }}" alt="{{ $user->nickname }}" />
					</div>
				</section>

				<!-- Nick Name -->
				<section class="form-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
					<label for="nickname" class="col-md-3 control-label">Tên hiển thị</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="nickname" disabled="disabled" value="{{$user->nickname}}">
						{{ $errors->first('nickname', '<span class="help-block text-danger">:message</span>') }}
					</div>
				</section>

				<!-- Location -->
				<section class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
					<label for="address" class="col-md-3 control-label">Nơi ở</label>
					<div class="col-md-8">
						<input type="text" class="form-control" name="address" id="address" value="{{ old('address', $user->address) }}">
						{{ $errors->first('address', '<span class="help-block text-danger">:message</span>') }}
					</div>
				</section>

				<!-- Biography -->
				<section class="form-group {{ $errors->has('biography') ? 'has-error' : '' }}">
					<label for="biography" class="col-md-3 control-label">Tiểu sử</label>
					<div class="col-md-8">
						<textarea name="biography" id="biography" class="form-control" rows="3">{{ old('biography', $user->biography) }}</textarea>
						{{ $errors->first('biography', '<span class="help-block text-danger">:message</span>') }}
					</div>
				</section>

				<!-- Hobbies -->
				<section class="form-group {{ $errors->has('hobbies') ? 'has-error' : '' }}">
					<label for="hobbies" class="col-md-3 control-label">Sở thích</label>
					<div class="col-md-8">
						<textarea name="hobbies" id="hobbies" class="form-control" rows="3">{{ old('hobbies', $user->hobbies) }}</textarea>
						{{ $errors->first('hobbies', '<span class="help-block text-danger">:message</span>') }}
					</div>
				</section>
				<hr>

				<div class="form-group">
					<div class="col-sm-12 text-center">
						<button type="submit" class="btn btn-sm btn-danger">Cập nhật thông tin</button>
						<input type="hidden" name="action" value="update-profile">
					</div>
				</div>
			</section>
		</form>
	</section>

	<!-- Change password -->
	<section class="col-sm-4">
		<h1 class="head-title"><i class="fa fa-key"></i> Đổi mật khẩu</h1>
		<form method="post" id="f-change-pwd" action="{{route('account.changePassword')}}" class="form-horizontal" autocomplete="off">
			{{csrf_field()}}
				@method('PUT')

			<!-- Old Password -->
			<section class="form-group {{ $errors->has('old_password') ? 'has-error' : '' }}">
			   <label for="old_password" class="col-sm-6 control-label">Mật khẩu hiện tại {!! $errors->first('old_password', '<span class="help-inline text-danger pull-right">:message</span>') !!}</label>
			   <div class="col-sm-6">
				  <input type="password" class="form-control" name="old_password" id="old_password">
			   </div>
			</section>

			<!-- New Password -->
			<section class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
			   <label for="password" class="col-sm-6 control-label">Mật khẩu mới {{ $errors->first('password', '<span class="help-inline text-danger pull-right">:message</span>') }}</label>
			   <div class="col-sm-6">
				  <input type="password" class="form-control" name="password" id="password">
			   </div>
			</section>

			<!-- Confirm New Password  -->
			<section class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
			   <label for="password_confirmation" class="col-sm-6 control-label">Xác nhận mật khẩu {{ $errors->first('password_confirm', '<span class="help-inline text-danger pull-right">:message</span>') }}</label>
			   <div class="col-sm-6">
				  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
			   </div>
			</section>
			<hr>

			<div class="form-group">
				<div class="col-sm-12 text-center">
					<button type="submit" class="btn btn-sm btn-primary">Đổi mật khẩu</button>
					<input type="hidden" name="action" value="change-password">
				</div>
			</div>
		</form>
	</section>
	<div class="clearfix"></div>
</section>
@stop

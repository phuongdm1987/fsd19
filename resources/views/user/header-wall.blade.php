<section class="header-wrapper">
	<div class="fsd-coverPicker">
		@if(auth()->check() && auth()->id() === $user->id)
			<div class="fsd-action-controls pull-right">
				<button id="fsd-button-edit" class="btn btn-danger btn-sm"><i class="fa fa-camera"></i> Thay đổi</button>
				<span id="fsd-button-control" class="hide">
					<button id="fsd-button-save" class="btn btn-info btn-sm">Save</button>
					<button id="fsd-button-cancel" class="btn btn-default btn-sm">Cancel</button>
					<input id="cover" type="hidden" name="cover" value="{{ $user->cover }}">
					<input id="avatar" type="hidden" name="avatar" value="{{ $user->gravatar }}">
				</span>
			</div>
		@endif

		<span class="fsd-icon-upload coverPickerControls hide">
			<i class="fa fa-camera fa-3x"></i>
			<input id="fsdCover" type="file" class="fsd-cover" name="file_cover"/>
		</span>
		<div class="fsdCoverOuter fsd-image fsd-cover" style="background-image: url('{{ $user->getCover() }}');"></div>
	</div>
	<div class="fsd-contentOuter text-center">
		<div class="fsd-avatarPicker">
			<span class="fsd-icon-upload avatarPickerControls hide">
				<i class="fa fa-camera fa-2x"></i>
				<input id="fsdAvatar" type="file" class="fsd-avatar" name="file_avatar"/>
			</span>
			<span class="fsd-avatar-image img-circle" style="background: url({{ $user->gravatar('large_') }}) no-repeat center center #fff; background-size: cover;"></span>
		</div>

		<div class="fsd-introductUser">
			<h1 class="fsd-nickName">{{ $user->nickname }}</h1>
			<p class="text-center">{{ $user->hobbies }}</p>
		</div>
	</div>
</section>

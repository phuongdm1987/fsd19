@if ($errors->any())
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	Vui lòng điền đầy đủ thông tin
</div>
@endif

@if ($message = session()->get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h4>Hoàn thành</h4>
	{{ $message }}
</div>
@endif

@if ($message = session()->get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	{{ $message }}
</div>
@endif

@if ($message = session()->get('warning'))
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h4>Cảnh báo</h4>
	{{ $message }}
</div>
@endif

@if ($message = session()->get('info'))
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h4>Thông tin</h4>
	{{ $message }}
</div>
@endif

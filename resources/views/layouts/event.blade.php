@if(time() <= strtotime("01/09/2015"))
	<h1 class="text-center" data-public="0">A big thing is coming...</h1>
	<p class="text-center">Một sự kiện cực kỳ thú vị sẽ diễn ra trong <strong id="countdown"></strong></p>
@else
	<h1 class="text-center" data-public="1">Kết nối cộng đồng developer Việt Nam</h1>
	<p class="text-center">Click để xem chi tiết!</p>
@endif
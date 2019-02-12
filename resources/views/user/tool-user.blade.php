<section class="fsd-box right-box">
	<h4 class="text-center">Công cụ</h4>
	<section class="box-controls text-center">
        {!! Henry\Support\Follower::createButtonFollow($user) !!}
		<p class="clearfix"></p>
        {!! Henry\Support\Follower::getCountFollowerAndFollowings($user) !!}
	</section>
</section>

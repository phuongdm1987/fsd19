<nav class="navbar navbar-default">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-menu">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{route('home')}}"
					style="background-image: url(http://nguyenhats.com/images/logo.png);
    				width: 120px; padding: 0; margin: 0; background-size: 100%;
    				height: 30px; margin-top: 10px; margin-right: 50px;"
				></a>
                <form action="{{route('quickSearch')}}" method="get" class="form-inline pull-left search-form hidden-sm">
                    <div>
                        <i class="fa fa-search"></i>
                        <input type="text" name="q" class="form-control" placeholder="Tìm kiếm mọi thứ...">
                    </div>
                </form>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="nav-menu">
				<ul class="nav navbar-nav navbar-right">
					<li class="hidden">
						<a href="{{route('home')}}"></a>
					</li>
					@foreach($categories as $category)
						<li class="dropdown hidden-xs">
							<a class="nav-item" href="{{ $category->url() }}">{{ $category->name }}</a>
							@if($category->has_child)
								<ul class="dropdown-menu fsd-menu-level-2 {{ str_slug($category->name) }}">
									@foreach($category->children as $children)
                                        <li class="fsd-submenu">
                                            <a href="{{ $children->url() }}" class="menu-item link-title">{{ $children->name }}</a>
                                            <ul class="list-unstyled fsd-menu-level-3">
                                                @foreach($children->children as $child)
                                                    <li><a href="{{ $child->url() }}" title="{{ $child->name }}" >{{ $child->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
									@endforeach
								</ul>
							@endif
						</li>
					@endforeach

					@if (auth()->check())
						<li class="dropdown hidden-xs">
							<a class="nav-item" id="account-info" href="/account" title="Đến trang cá nhân {{ auth()->user()->nickName() }}" style="position: relative; padding-left: 40px">
								<span class="author-block pull-left img-circle" style="background: url({{ auth()->user()->gravatar('medium_') }}) no-repeat center center;background-size: cover; width: 32px;height: 32px; display: block; position: absolute; top: 0px; left: 5px"></span>
								{{ auth()->user()->nickName() }}
							</a>
						</li>
					@else
						<li>
							<a class="nav-item" id="post-blog" href="{{ route('login') }}" title="Viết bài">Đăng nhập</a>
						</li>
					@endif
					<li class="visible-sm"><button id="btn-toggle-search" class="btn btn-default"><i class="fa fa-search"></i></button></li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>

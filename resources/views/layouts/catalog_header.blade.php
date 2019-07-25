<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_content ml-auto">
							@if (auth()->check())

								<div class="top_bar_user">
									<div class="user_icon"><i class="fas fa-clone" style="color: #aaa"></i></div>
									<div><a href="{{ url('catalog/compare') }}">Compare <span class="badge" style="background-color: #0e8ce4;
    color: #fff;
    border-radius: 50%;">{{ !empty(session()->get('compare')) ? count(session()->get('compare')) : 0 }}</span></a></div>
								</div>

								<div class="top_bar_menu">
									<ul class="standard_dropdown top_bar_dropdown">
										<li>
											<a href="#">{{ auth()->user()->name }}<i class="fal fa-chevron-down"></i></a>
											<ul>
												<li><a href="{{ url('dashboard') }}">Dashboard</a></li>
												
												<form action="{{ route('logout') }}" method="POST" id="form-logout" style="display:none">
												{{ csrf_field() }}
												</form>
												<li><a onclick="document.getElementById('form-logout').submit()" href="javascript:void(0)"><i class="fas fa-lock"></i> Logout</a></li>
											</ul>
										</li>
									</ul>
								</div>
							@else
								<div class="top_bar_user">
									<div class="user_icon"><img src="assets/images/catalog/user.svg" alt=""></div>
									<div><a href="login">Sign in</a></div>
								</div>
							@endif
							
						</div>
					</div>
				</div>
			</div>		
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-4 col-sm-4 col-3 order-1">
						<div class="logo_container">
						<div class="logo"><a href="{{ url('/') }}">Cubic Pro</a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
                                <form action="{{ url('catalog') }}" class="header_search_form clearfix" method="get">
                                <input type="search" name="keyword" required="required" class="header_search_input" placeholder="Search for products..." value="{{ request()->keyword }}">
                                        <input type="text" name="category" hidden="hidden" id="category-search">
                                        <div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">All Categories</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
												<li><a href="#">All Categories</a></li>
                                                    @foreach (App\ItemCategory::get() as $category)
                                                    <li><a href="#" data-category-id="{{ $category->id }}">{{ $category->category_code}} ( {{$category->category_name}} )</a></li>
                                                    @endforeach
													
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ url('assets/images/catalog/search.png') }}" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-2 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{ url('assets/images/catalog/cart.png') }}" alt="">
									<div class="cart_count"><span>{{ \App\Cart::countTotal()->pluck('qty')->sum() }}</span></div>
									</div>
									<div class="cart_content">
									<div class="cart_text"><a href="{{ url('cart') }}">Cart</a></div>
									<div class="cart_price">Rp. {{ \App\Cart::countTotal() ? number_format(\App\Cart::countTotal()->pluck('total')->sum()) : '0' }}</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		
		<!-- Main Navigation -->

		<nav class="main_nav">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="main_nav_content d-flex flex-row">

							<!-- Categories Menu -->

							<div class="cat_menu_container">
								<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
									<div class="cat_burger"><span></span><span></span><span></span></div>
									<div class="cat_menu_text">categories</div>
								</div>

								<ul class="cat_menu">
								<li><a href="{{ url('catalog') }}">All Category</a></li>
									@foreach (App\ItemCategory::get() as $category)
										<li><a href="{{ url('catalog?category='.$category->id) }}">{{ $category->category_code}} ( {{$category->category_name}} )</a></li>
									@endforeach
								</ul>
							</div>

							<!-- Main Nav Menu -->

							<div class="main_nav_menu ml-auto">
								<ul class="standard_dropdown main_nav_dropdown">
									
								</ul>
							</div>

							<!-- Menu Trigger -->

							<div class="menu_trigger_container ml-auto">
								<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
									<div class="menu_burger">
										<div class="menu_trigger_text">menu</div>
										<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</nav>
		
		<!-- Menu -->

		<div class="page_menu">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="page_menu_content">
							
							<div class="page_menu_search">
								<form action="#">
									<input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
								</form>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>
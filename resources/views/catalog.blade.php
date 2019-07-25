@extends('layouts.catalog')
@section('title', 'Home')
@section('content')
<div class="super_container">
	
	<!-- Header -->
	
	@include('layouts.catalog_header')
	
	<!-- Banner -->

	<div class="banner" style="height: 500px; margin-bottom: 100px">
		<div class="banner_background" style="background-image:url(assets/images/catalog/banner_background.jpg)"></div>
		<div class="container fill_height">
			<div class="row fill_height">
				<div class="banner_product_image"><img src="assets/images/catalog/banner_new.png" alt=""></div>
				<div class="col-lg-5 offset-lg-4 fill_height">
					<div class="banner_content">
						<h1 class="banner_text">EPS Electronic Purchasing System</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Deals of the week -->

	@foreach ($categories as $category)
	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div class="new_arrivals_title">{{ $category->category_code}} ( {{$category->category_name}} )</div>
							<ul class="clearfix">
								<li class="active"></li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="row">
							<div class="col-lg-9">

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">

										@foreach ($category->items->take(10) as $item)
										
											<div class="arrivals_slider_item">
												<div class="border_active"></div>
												<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center" style="padding-bottom: 30px; cursor: default">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><a href="{{ url('catalog/'.$item->item_code) }}"><img class="img-slick" src="{{ !empty($item->feature_image) ?  url('uploads/'.$item->feature_image) : url('assets/images/default-image.png') }}" alt=""></a></div>
													<div class="product_content">
														<div class="product_price">Rp. {{ number_format($item->item_price) }}</div>
													<div class="product_name"><div><a href="{{ url('catalog/'.$item->item_code) }}">{{ ucfirst($item->item_description) }} <br> <small>{{ $item->item_code }}</small></a></div></div>
													</div>
												</div>
											</div>

										@endforeach
										
									</div>
									<div class="arrivals_slider_dots_cover"></div>
								</div>


							</div>

							<div class="col-lg-3">
								<div class="arrivals_single clearfix">
									<div class="d-flex flex-column align-items-center justify-content-center">
										<div class="arrivals_single_content">
											<div class="arrivals_single_image"><img src="{{ !empty($category->feature_image) ? url('uploads/'.$category->feature_image) : url('assets/images/default-image.png') }}" alt=""></div>
											<div class="arrivals_single_category"><a href="#">Category</a></div>
											<div class="arrivals_single_name_container clearfix">
												<div class="arrivals_single_name"><a href="#">{{ $category->category_code}} ( {{$category->category_name}} )</a></div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
								
					</div>
				</div>
			</div>
		</div>		
	</div>
	@endforeach
</div>
@endsection

@push('style')
	<link rel="stylesheet" type="text/css" href="assets/styles/bootstrap4/bootstrap.min.css">
	<link href="assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="assets/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/plugins/slick-1.8.0/slick.css">
	<link rel="stylesheet" type="text/css" href="assets/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="assets/styles/responsive.css">
@endpush

@push('js')
	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="assets/styles/bootstrap4/popper.js"></script>
	<script src="assets/styles/bootstrap4/bootstrap.min.js"></script>
	<script src="assets/plugins/greensock/TweenMax.min.js"></script>
	<script src="assets/plugins/greensock/TimelineMax.min.js"></script>
	<script src="assets/plugins/scrollmagic/ScrollMagic.min.js"></script>
	<script src="assets/plugins/greensock/animation.gsap.min.js"></script>
	<script src="assets/plugins/greensock/ScrollToPlugin.min.js"></script>
	<script src="assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="assets/plugins/slick-1.8.0/slick.js"></script>
	<script src="assets/plugins/easing/easing.js"></script>
	<script src="assets/js/custom.js"></script>
@endpush
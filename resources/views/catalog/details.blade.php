@extends('layouts.catalog')
@section('title')
    {{ $items->first()->item_description }}
@endsection
@section('content')
<div class="super_container">
	
    @include('layouts.catalog_header')
    

    <div class="single_product">
        <div class="container">
            <div class="row">

                <!-- Images -->
                <div class="col-lg-2 order-lg-1 order-2">
                    <ul class="image_list">
                        @foreach ($items as $item)
                        <li data-image="{{ url('uploads/'.$item->feature_image) }}"><img src="{{ url('uploads/'.$item->feature_image) }}" alt=""></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Selected Image -->
                <div class="col-lg-5 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{ url('uploads/'.$items->first()->feature_image) }}" alt=""></div>
                </div>

                <!-- Description -->
                <div class="col-lg-5 order-3">
                    <div class="product_description">
                        <div class="product_category">{{ $items->first()->item_category->category_name }}</div>
                        <div class="product_name">{{ ucfirst($items->first()->item_description) }}</div>
                        <div class="product_text"><p>{{ $items->first()->item_specification }}</p></div>
                        <br>
                        <br>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Supplier</th>
                                    <th>Lead Time</th>
                                    <th class="text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i = 1)
                                @foreach ($items as $item)
                                <tr>
                                    <td class="text-center">{{ $i }}</td>
                                    <td>{{ $item->supplier->supplier_name }}</td>
                                    <td>{{ $item->lead_times }}</td>
                                    <td class="text-primary text-right" style="min-width: 120px"><strong>Rp. {{ number_format($item->item_price) }}</strong></td>
                                </tr>
                                @php($i++)
                                @endforeach
                            </tbody>
                        </table>

                        <div class="order_info d-flex flex-row">
                            <form style="width: 100% !important" method="post" action="{{ url('catalog') }}">
                                @csrf
                                <div class="row"> 

                                    <div class="col-md-10">
                                        <div class="form-group" style="margin-top: 20px">
                                            <label class="control-label" style="color: #828282">Supplier :</label>
                                            <select name="item_id" class="form-control" style="margin: 0px; color: rgb(130, 130, 130); width: 100% !important;">
                                                    @php ($j = 1)
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->supplier->supplier_name }} (#{{$j}})</option>
                                                    @php($j++)
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="clearfix" style="z-index: 1000;">
                                            <!-- Product Quantity -->
                                            <div class="product_quantity clearfix">
                                                <span>Quantity: </span>
                                                <input id="quantity_input" type="text" pattern="[0-9]*" value="1" name="qty">
                                                <div class="quantity_buttons">
                                                    <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                                    <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group" style="margin-top: 20px">
                                            <label class="control-label" style="color: #828282">Reason why did you buy this product :</label>
                                            <textarea name="reason" rows="6" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Product Color -->                                      
                                </div>
                                
                                

                                <div class="button_container">
                                    <button type="submit" class="button cart_button" name="submit" value="cart">Add to Cart</button>
                                    <button type="submit" class="btn btn-info btn-lg" style="cursor:pointer" name="submit" value="compare">Compare</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@push('style')
<link rel="stylesheet" type="text/css" href="{{ url('assets/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ url('assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ url('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/styles/product_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/styles/product_responsive.css') }}">
@endpush

@push('js')
<script src="{{ url('assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ url('assets/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ url('assets/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ url('assets/plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ url('assets/plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ url('assets/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ url('assets/plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ url('assets/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ url('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ url('assets/plugins/easing/easing.js') }}"></script>
<script src="{{ url('assets/js/product_custom.js') }}"></script>
@endpush
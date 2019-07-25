@extends('layouts.catalog')
@section('title', 'Cart')
@section('content')
<div class="super_container">
	
    @include('layouts.catalog_header')
    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart_container">
                        <div class="cart_title">Shopping Cart</div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach ($carts as $cart)
                                <li class="cart_item clearfix" id="{{ $cart->id }}">
                                    <div class="cart_item_image"><img style="width: 100%; height: 100%; object-fit: contain;" src="{{ url('uploads/'.$cart->item->feature_image) }}" alt=""></div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col"  style="margin-right: 15px;">
                                            @if ($loop->first)
                                            <div class="cart_item_title">Name</div>
                                            @endif
                                            <div class="cart_item_text">{{ ucfirst($cart->item->item_description) }}</div>
                                        </div>
                                        <div class="cart_item_title cart_info_col">
                                            @if ($loop->first)
                                            <div class="cart_item_title">Suppler</div>
                                            @endif
                                            <div class="cart_item_text">{{ $cart->item->supplier->supplier_name }}</div>
                                        </div>
                                        <div class="cart_item_quantity cart_info_col">
                                                @if ($loop->first)
                                            <div class="cart_item_title">Quantity</div>
                                            @endif
                                            <div class="cart_item_text">
                                                <div class="product_quantity clearfix" style="margin:0px">
                                                    <input data-id="{{ $cart->id }}" class="quantity_input" type="text" pattern="[0-9]*" value="{{ $cart->qty }}" name="qty">
                                                    <div class="quantity_buttons">
                                                        <div class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                                        <div class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart_item_name cart_info_col">
                                                @if ($loop->first)
                                                <div class="cart_item_title">Reason</div>
                                                @endif
                                                <div class="cart_item_text">{{ $cart->reason }}</div>
                                            </div>
                                        <div class="cart_item_price cart_info_col">
                                                @if ($loop->first)
                                            <div class="cart_item_title">Price</div>
                                            @endif
                                            <div class="cart_item_text field_price">Rp. {{ number_format($cart->price) }}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                                @if ($loop->first)
                                            <div class="cart_item_title">Total</div>
                                            @endif
                                            <div class="cart_item_text" id="field_total_{{$cart->id}}">Rp. {{ number_format($cart->total) }}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_text"><a href="#" data-id="{{$cart->id}}" class="btn btn-sm btn-link text-danger btn-remove"><i class="fas fa-times"></i></a></div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <!-- Order Total -->
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount field_total_amount">Rp. {{ number_format($carts->pluck('total')->sum()) }}</div>
                            </div>
                        </div>

                        <div class="cart_buttons">
                            <button type="button" class="button cart_button_checkout" id="btn-checkout">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ url('cart/checkout') }}" method="get">
    <div class="modal" tabindex="-1" role="dialog" id="modal-cart">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Checkout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="control-label">Select Budget Type</label>
                            <select name="budget_type" class="form-control">
                                <option value="capex">Capex</option>
                                <option value="expense">Expense</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" style="cursor:pointer">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor:pointer">Close</button>
            </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('style')
<link rel="stylesheet" type="text/css" href="{{ url('assets/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ url('assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ url('assets/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('assets/styles/cart_responsive.css') }}">
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
<script src="{{ url('assets/plugins/easing/easing.js') }}"></script>
<script src="{{ url('assets/js/cart_custom.js') }}"></script>
<script src="{{ url('assets/js/pages/cart.js') }}"></script>

@endpush
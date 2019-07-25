@extends('layouts.catalog')
@section('title', 'Compare')
@section('content')
<div class="super_container">
	
    @include('layouts.catalog_header')
    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart_container">
                        <div class="cart_title">Comparison</div>
                        <div class="cart_items">
                            @if (!empty($compares))
                            <table class="table table-responsive table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="vertical-align:middle; text-align:center; width: 200px">Aspect</th>
                                        <th colspan="{{ count($compares) }}" class="text-center">Supplier Candidat</th>
                                    </tr>
                                    <tr>
                                        @foreach ($compares as $compare)
                                            <td class="text-center">{{ $compare['supplier'] }} <a href="{{ url('catalog/compare/remove/'.$compare['id']) }}" class="btn btn-danger btn-sm btn-link text-danger float-right"><i class="fas fa-times"></i></a></td>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1. Specification</td>
                                        @foreach ($compares as $compare)
                                        <td>{{ $compare['specification'] }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>2. Price</td>
                                        @foreach ($compares as $compare)
                                        <td class="text-right">Rp. {{ number_format($compare['price']) }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>3. Lead Times</td>
                                        @foreach ($compares as $compare)
                                        <td>{{ $compare['lead_times'] }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>4. After Sales</td>
                                        @foreach ($compares as $compare)
                                        <td></td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>&nbsp; &nbsp; 4.1 Guarantee</td>
                                        @foreach ($compares as $compare)
                                        <td>{{ $compare['guarantee'] }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>&nbsp; &nbsp; 4.1 Technical Support</td>
                                        @foreach ($compares as $compare)
                                        <td>{{ $compare['technical_support'] }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>&nbsp; &nbsp; 4.1 Others</td>
                                        @foreach ($compares as $compare)
                                        <td>{{ $compare['other'] }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>

                            <div class="cart_buttons">
                                <a href="{{ url('catalog/compare/print') }}" class="button cart_button_checkout" id="btn-checkout">Print</a>
                            </div>
                            @else
                            
                            <h2 class="text-muted">No Comparison yet!</h2>

                            @endif
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
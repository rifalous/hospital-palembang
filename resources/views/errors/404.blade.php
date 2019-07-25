@extends('layouts.error_layouts')

@section('title')
	404 Not Found
@endsection

@section('content')

<div class="container-alt">
    <div class="row">
        <div class="col-sm-12 text-center">

            <div class="wrapper-page">
                <img src="{{ url('assets/images/animat-search-color.gif') }}" alt="" height="120">
                <h1 style="font-size: 78px;">404</h1>
                <h3 class="text-uppercase text-danger">Page not found</h3>
                <p class="text-muted">It's looking like you may have taken a wrong turn. Don't worry... it
                    happens to the best of us. You might want to check your internet connection. Here's a
                    little tip that might help you get back on track.</p>

                <a class="btn btn-success waves-effect waves-light m-t-20" href="{{ url('dashboard') }}"> Return Home</a>
            </div>

        </div>
    </div>
</div>

@endsection
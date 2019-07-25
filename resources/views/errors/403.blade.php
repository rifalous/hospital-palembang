@extends('layouts.error_layouts')

@section('title')
	403 Unauthorize
@endsection

@section('content')

<div class="container-alt">
    <div class="row">
        <div class="col-sm-12 text-center">

            <div class="wrapper-page">
                <img src="{{ url('assets/images/animat-rocket-color.gif') }}" alt="" height="120">
                <h1 style="font-size: 78px;">403</h1>
                <h3 class="text-uppercase text-danger">Unauthorize</h3>
                <p class="text-muted">You are not authorize to access this page</p>

                <a class="btn btn-success waves-effect waves-light m-t-20" href="{{ url('dashboard') }}"> Return Home</a>
            </div>

        </div>
    </div>
</div>

@endsection
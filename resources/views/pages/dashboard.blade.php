@extends('layouts.master')

@section('title')
	Dashboard
@endsection

@section('content')

@php($active = 'dashboard')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li class="active">
                        Dashboard
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
		</div
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-primary">
                <i class="fa fa-user-md widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Dokter">Dokter</p>
                    <h2><span data-plugin="counterup">{{ count($doctors) }}</span> <small></small></h1>
                    <!-- <p class="text-muted m-0"><b>Last:</b> 30.4k</p> -->
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-warning">
                <i class="mdi mdi-account widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">User</p>
                    <h2><span data-plugin="counterup">{{ count($users)}}</span> <small></small></h2>
                    <!-- <p class="text-muted m-0"><b>Last:</b> 40.33k</p> -->
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-danger">
                <i class="mdi mdi-hospital-building widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Pasien Rawat Inap">Pasien Rawat Inap</p>
                    <h2><span data-plugin="counterup">{{count($inpatient)}}</span> <small></small></h2>
                    <!-- <p class="text-muted m-0"><b>Last:</b> 30.4k</p> -->
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-success">
                <i class="mdi mdi-account-convert widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Pasien Rawat Jalan">Pasien Rawat Jalan</p>
                    <h2><span data-plugin="counterup">{{count($outpatient)}}</span> <small></small></h2>
                    <!-- <p class="text-muted m-0"><b>Last:</b> 1250</p> -->
                </div>
            </div>
        </div><!-- end col -->
    </div>

    <div class="row">
        <div class="col-xs-6">
            {!! $chart->container() !!}
        </div><!-- end col -->
        <div class="col-xs-6">
            {!! $chart2->container() !!}
        </div><!-- end col -->
    </div>
</div> <!-- container -->

@endsection

@push('js')
@if (session()->has('message'))
    <script type="text/javascript">
        show_notification("{{ session('title') }}","{{ session('type') }}","{{ session('message') }}");
    </script>
@endif
<script src="{{ url('assets/js/pages/dashboard.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $chart->script() !!}
{!! $chart2->script() !!}
@endpush

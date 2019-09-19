@extends('layouts.master')

@section('title')
	Rekam Medis
@endsection

@section('content')

@php($active = 'medical_records')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Rekam Medis</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li class="active">
                    Rekam Medis
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
		</div>
	</div>
    <!-- end row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">

                <div class="row m-b-30">
                <div class="col-md-4">
                    <div class="pull-left">
                    <div class="input-group">
                        <input class="form-control input-sm" placeholder="Masukkan Nomor Rekam Medis" type="text" id="search">
                        <span class="input-group-btn">
                        <button class="btn btn-inverse btn-sm" type="button" onclick="on_search()" data-toggle="tooltip" data-original-title="Search"><i class="mdi mdi-magnify"></i></button>
                        <button class="btn btn-inverse btn-sm" type="button" onclick="on_clear_search()" data-toggle="tooltip" data-original-title="Clear"><i class="mdi mdi-close"></i></button>
                        </span>
                    </div>
                    </div>
                </div>
                </div>
                <table class="table m-0 table-colored table-inverse" id="table-medical_records">
                    <thead>
                        <tr>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>No Reg. / Tgl Rawat Inap</th>
                            <th>Rawat Inap Diagnosa</th>
                            <th>No Reg. / Tgl Rawat Jalan</th>
                            <th>Rawat Jalan Diagnosa</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data->sortBy('no_rm') as $row)
                        <tr>
                            <td>{{ $row->no_rm }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->inpatients_noregist }} / {{ $row->tgl_masuk }}</td>
                            <td>{{ $row->inpatients_disease }}</td>
                            <td>{{ $row->outpatients_noregist }} / {{ $row->tgl_periksa }}</td>
                            <td>{{ $row->outpatients_disease }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
@push('js')

@if (session()->has('message'))
    <script type="text/javascript">
        show_notification("{{ session('title') }}","{{ session('type') }}","{{ session('message') }}");
    </script>
@endif
@endpush

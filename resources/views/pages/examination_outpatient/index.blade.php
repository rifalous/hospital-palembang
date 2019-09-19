@extends('layouts.master')

@section('title')
	Pemeriksaan Rawat Jalan
@endsection

@section('content')

@php($active = 'examination_outpatient')


<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Pemeriksaan Rawat Jalan</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="#">Pemeriksaan Rawat Jalan</a>
                    </li>
                    <li class="active">
                        Data Pemeriksaan Rawat Jalan
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
		</div>
	</div>
	<div class="row">
        <div class="col-md-12">
            <div class="card-box">
				<div class="row m-b-30">
                    <div class="col-md-8">
                        <div class="pull-left">
                        <a href="{{ route('examination_outpatient.create') }}" class="btn btn-primary btn-bordered waves-effect waves-light"><i class="mdi mdi-plus"></i> Tambah </a>
                        <!--<button class="btn btn-primary btn-bordered waves-effect waves-light" onclick="on_edit()">Ubah</button>
                        <button class="btn btn-primary btn-bordered waves-effect waves-light" onclick="on_delete()">Hapus</button>-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pull-right">
                            <div class="input-group">
                                <input class="form-control input-sm" placeholder="Pencarian..." type="text" id="search">
                                <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button" onclick="on_search()" data-toggle="tooltip" data-original-title="Search"><i class="mdi mdi-magnify"></i></button>
                                <button class="btn btn-primary btn-sm" type="button" onclick="on_clear_search()" data-toggle="tooltip" data-original-title="Clear"><i class="mdi mdi-close"></i></button>
                                </span>
                            </div>
                        </div>    
                    </div>
                </div>
                <table class="table table-bordered" id="table-examination-outpatient">
                    <thead>
                        <tr>
                            <th style="width: 50px"></th>
                            <th>Nama Pasien/No Registrasi</th>
                            <th>Tanggal Pemeriksaan</th>
                            <th>Total Tindakan</th>
                            <th>Total Obat</th>
                            <th>Total Pembayaran</th>
                            <th style="width: 100px">Opsi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal delete -->

<!-- Modal for question -->
<div class="modal fade in" tabindex="-1" role="dialog" id="modal-delete-confirm">
	<div class="modal-dialog modal-sm">
	  <div class="modal-content">
		  <div class="modal-header">
			  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
			  <h4 class="modal-title">Apakah Kamu Yakin?</h4>
		  </div>
		  <div class="modal-body">Semua Yang Kamu Pilih Akan Terhapus, Anda Yakin?</div>
		  <div class="modal-footer">
			<button type="button" id="btn-confirm" class="btn btn-primary btn-sm">Ya</button>
			<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
		</div>
	  </div>
	</div>
</div>

<style>
.dataTables_filter, .dataTables_info { display: none; }
</style>
@endsection

@push('js')
<script src="{{ url('assets/js/pages/examination_outpatient.js') }}"></script>
@endpush
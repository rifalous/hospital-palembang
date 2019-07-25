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
        <div class="col-sm-4">
             <a href="{{ route('examination_outpatient.create') }}" class="btn btn-inverse btn-bordered waves-effect waves-light m-b-20"><i class="mdi mdi-plus"></i> Tambah Pemeriksaan Rawat Jalan</a>
        </div><!-- end col -->
    </div>

	<div class="row">
        <div class="col-md-12">
            <div class="card-box">
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
@endsection

@push('js')
<script src="{{ url('assets/js/pages/examination_outpatient.js') }}"></script>
@endpush
@extends('layouts.master')

@section('title')
  Laporan Pembayaran Rawat Inap Periode
@endsection

@section('content')

@php($active = 'hospitalisationday')

<div class="container">
  <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Laporan Pembayaran Rawat Inap Periode</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li class="active">
                    Pembayaran Rawat Inap Periode
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
		</div>
	</div>

    <!-- end row -->

    <div class="row">
    <div class="col-xs-12">
      <div class="card-box">
        <div class="row m-b-30">
          <div class="form-group">
            <form action="{{ url('inpatient_periode/download') }}" method="post">
              @csrf
              <div class="col-md-2">
                <div class="form-group">
                    <input name="start_date" id="tanggal" class="form-control datepicker" required="required" placeholder="yyyy-mm-dd" aria-invalid="false" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                    <input name="end_date" id="tanggal1" class="form-control datepicker" required="required" placeholder="yyyy-mm-dd" aria-invalid="false" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>
              </div>
        
              <div class="col-md-1">
                <button type="button" class="btn btn-primary btn-bordered waves-effect waves-light" onclick="on_filter()">Filter</button>
              </div>
                <div class="col-md-1">
                        <button type="submit" class="btn btn-primary btn-bordered waves-effect waves-light">Unduh PDF</button>
                </div>
            </form>
          </div>
          <table id="table-inpatient-periode" class="table table-bordered table-responsive">
            <thead>
              <tr>  
                <th>No Registrasi</th>
                <th>Nama</th>
                <th>Tanggal Bayar</th>
                <th>Total Biaya</th>
                <th>Sisa Tagihan</th>
                <th>Sisa Pembayaran</th>
                <th>Pembayaran</th>
              </tr>
            </thead>
          </table>
      </div>
    </div>
  </div>

</div>

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

@if (session()->has('message'))
    <script type="text/javascript">
        show_notification("{{ session('title') }}","{{ session('type') }}","{{ session('message') }}");
    </script>
@endif

<script src="{{ url('assets/js/pages/inpatient_periode.js') }}"></script>
@endpush
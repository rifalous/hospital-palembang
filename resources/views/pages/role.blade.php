@extends('layouts.master')

@section('title')
	Peran
@endsection

@section('content')

@php($active = 'settings/role')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Peran</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li class="active">
                        Peran
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
		</div>
	</div>
    <!-- end row -->

    <div class="row">
        <div class="col-md-12 m-b-20">
            <div class="pull-left">
                <a href="{{ route('role.create') }}" class="btn btn-inverse btn-bordered waves-effect waves-light"><i class="mdi mdi-plus"></i>Tambah Peran Baru</a>
            </div>
        </div>
    	<div class="col-md-12">
            <table class="table table-bordered" id="tbl-role">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th style="width: 150px">Opsi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</div>


<!-- Modal for question -->
<div class="modal fade in" tabindex="-1" role="dialog" id="modal-delete-confirm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Apakah anda yakin?</h4>
            </div>
            <div class="modal-body">Data yang dipilih akan dihapus, apakah anda yakin?</div>
            <div class="modal-footer">
                <button type="submit" id="btn-confirm" class="btn btn-danger btn-bordered waves-effect waves-light">Hapus</button>
                <button type="button" class="btn btn-default btn-bordered waves-effect waves-light" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

@endsection


@push('js')
<script src="{{ url('assets/js/pages/role.js') }}"></script>
@if (session()->has('message'))
<script type="text/javascript">
	show_notification("{{ session('title') }}","{{ session('type') }}","{{ session('message') }}");
</script>
@endif
@endpush
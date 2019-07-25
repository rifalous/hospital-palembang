@extends('layouts.master')

@section('title')
    Tambah Departemen
@endsection

@section('content')

@php($active = 'department')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Departemen</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('department.index') }}">Departemen</a>
                    </li>
                    <li class="active">
                    Tambah Departemen
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
                <div class="row">
                    <form method="post" action="{{ route('department.store') }}" id="form-add-edit">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kode Departemen<span class="text-danger">*</span></label>
                                <input type="text" name="department_code" class="form-control" placeholder="Kode Departemen" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Nama Departemen<span class="text-danger">*</span></label>
                                <input type="text" name="department_name" class="form-control" placeholder="Nama Departemen" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Nama Divisi<span class="text-danger">*</span></label>
                                <select name="division_id" class="select2" data-placeholder="Pilih Divisi" required="required">
                                    <option></option>
                                    @foreach ($division as $division)
                                    <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">SAP Key</label>
                                <input type="text" name="sap_key" class="form-control" placeholder="SAP Key">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <hr>

                            <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>

                            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')
<script src="{{ url('assets/js/pages/department-add-edit.js') }}"></script>
@endpush
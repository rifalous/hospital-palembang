@extends('layouts.master')

@section('title')
Tambah Divisi
@endsection

@section('content')

@php($active = 'division')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Divisi</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('division.index') }}">Divisi</a>
                    </li>
                    <li class="active">
                    Tambah Divisi
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
                    <form method="post" action="{{ route('division.store') }}" id="form-add-edit">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Kode Divisi<span class="text-danger">*</span></label>
                                <input type="text" name="division_code" class="form-control" placeholder="Kode Divisi" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Nama Divisi<span class="text-danger">*</span></label>
                                <input type="text" name="division_name" class="form-control" placeholder="Nama Divisi" required="required">
                                <!-- <textarea rows="5" placeholder="Division Name" name="division_name" class="form-control"></textarea> -->
                            </div>

                            <div class="form-group">
                                <label class="control-label">Direktur<span class="text-danger">*</span></label>
                                <select name="dir_key" class="select2" data-placeholder="Pilih Direktur" required="required">
                                    <option></option>
                                    @foreach ($dir_keys as $dir_key)
                                    <option value="{{ $dir_key['id'] }}">{{ $dir_key['text'] }}</option>
                                    @endforeach
                                </select>
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
<script src="{{ url('assets/js/pages/division-add-edit.js') }}"></script>
@endpush
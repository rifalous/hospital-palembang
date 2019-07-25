@extends('layouts.master')

@section('title')
	Tambah Kelas
@endsection

@section('content')

@php($active = 'level')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Kelas</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('level.index') }}">Kelas</a>
                    </li>
                    <li class="active">
                        Tambah Kelas
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
                    <form method="post" action="{{ route('level.store') }}" id="form-add-edit">
                        @csrf
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Kode Kelas<span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" value="{{$getCodeLevel}}" placeholder="eg: 0001" readonly="readonly" required="required" maxlength="12">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label class="control-label">Kelas<span class="text-danger">*</span></label>
                                <input type="text" name="class" class="form-control" placeholder="eg: A12" required="required" maxlength="25">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-4">    
                            <div class="form-group">
                                <label class="control-label">Tarif<span class="text-danger">*</span></label>
                                <input type="text" name="tarif" class="form-control number" placeholder="Masukan Tarif" value="0" required="required">
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
<script src="{{ url('assets/js/pages/level-add-edit.js') }}"></script>
@endpush
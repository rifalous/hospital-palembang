@extends('layouts.master')

@section('title')
	Tambah Dokter 
@endsection

@section('content')

@php($active = 'doctor')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Dokter </h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('doctor.index') }}">Dokter </a>
                    </li>
                    <li class="active">
                        Tambah Dokter 
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
                    <form method="post" action="{{ route('doctor.store') }}" id="form-add-edit">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kode Dokter<span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="eg: 0001" value="{{$getCodeDoctor}}" readonly="readonly" required="required" >
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">NIP<span class="text-danger">*</span></label>
                                <input type="text" name="nip" class="form-control number" placeholder="eg: 341112131XXX" required="required" maxlength="16">
                                <span class="help-block"></span>
                            </div>

                        </div>

                        <div class="col-md-6">    
                            <div class="form-group">
                                <label class="control-label">Nama Dokter<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="eg: Diana Nasution" required="required" maxlength="50">
                            </div>

                            <div class="form-group">
                                <label class="control-label">No Telepon<span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control number" placeholder="eg: 081288xxxxxx" required="required" maxlength="12"></input>
                            </div>
                        </div>

                        <div class="col-md-12">   
                            <div class="form-group">
                                <label class="control-label">Alamat<span class="text-danger">*</span></label>
                                <textarea type="text" name="address" class="form-control" placeholder="eg: Jalan Jenderal Sudirman Cimahi Tengah " rows="6" required="required" maxlength="125"></textarea>
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
<script src="{{ url('assets/js/pages/doctor-add-edit.js') }}"></script>
@endpush
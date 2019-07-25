@extends('layouts.master')

@section('title')
    Ubah Dokter
@endsection

@section('content')

@php($active = 'doctor')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Ubah Dokter</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('doctor.index') }}">Dokter</a>
                    </li>
                    <li class="active">
                        Ubah Dokter
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
                    <form method="post" action="{{ route('doctor.update', $doctor->id) }}" id="form-add-edit">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kode Dokter<span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="eg: 0001" required="required" value="{{ $doctor->code }}">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">NIP<span class="text-danger">*</span></label>
                                <input type="text" name="nip" class="form-control" placeholder="eg: 341112131XXX" required="required" value="{{ $doctor->nip }}">
                                <span class="help-block"></span>
                            </div>

                        </div>

                        <div class="col-md-6">    
                            <div class="form-group">
                                <label class="control-label">Nama Dokter<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="eg: Diana Nasution" required="required" value="{{ $doctor->name }}">
                            </div>

                            <div class="form-group">
                                <label class="control-label">No Telepon<span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" placeholder="eg: 081288xxxxxx"  required="required" value="{{ $doctor->phone }}"></input>
                            </div>

                            
                        </div>

                        <div class="col-md-12">    
                            <div class="form-group">
                                <label class="control-label">Alamat<span class="text-danger">*</span></label>
                                <textarea type="text" name="address" class="form-control" rows="6" placeholder="eg: Jalan Jenderal Sudirman Cimahi Tengah" required="required" >{{ $doctor->address }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <hr>

                            <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>

                            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan Perubahan</button>

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
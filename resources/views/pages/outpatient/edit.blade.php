@extends('layouts.master')

@section('title')
    Edit Registrasi Rawat Jalan
@endsection

@section('content')

@php($active = 'registration_outpatient')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Registrasi Rawat Jalan</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('registration_outpatient.index') }}">Registrasi Rawat Jalan</a>
                    </li>
                    <li class="active">
                        Edit Registrasi Rawat Jalan
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->


    <form method="post" action="{{ route('registration_outpatient.update', $registration_outpatient->id) }}" id="form-add-edit">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nomor Registrasi<span class="text-danger">*</span></label>
                                <input type="text" name="no_registrasi" readonly="readonly" placeholder="eg: 00001" class="form-control" value="{{ $registration_outpatient->no_registrasi }}" required="required">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">No RM<span class="text-danger">*</span></label>
                                <select name="pasien_id" class="select2" data-placeholder="Pilih No Rekam Medis" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($pasiens as $pasien)
                                        <option value="{{ $pasien['id'] }}"{{ $pasien['id'] == $registration_outpatient->pasien_id ? 'selected=selected' : '' }}>{{ $pasien['no_rm'] }} - {{ $pasien['name'] }} - {{ $pasien->details['identification_number'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Poliklinik<span class="text-danger">*</span></label>
                                <select name="poliklinik" class="select2" data-placeholder="Pilih Poliklinik" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($polikliniks as $poliklinik)
                                        <option value="{{ $poliklinik['id'] }}"{{ $poliklinik['id'] == $registration_outpatient->poliklinik ? 'selected=selected' : '' }}>{{ $poliklinik['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Periksa<span class="text-danger">*</span></label>
                                        <input type="text" name="tgl_periksa" class="form-control datepicker" placeholder="yyyy-mm-dd" readonly="readonly" value="{{ $registration_outpatient->tgl_periksa }}"  required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Diagnosa<span class="text-danger">*</span></label>
                                        <input type="text" name="disease" class="form-control" placeholder="eg: Sakit Perut" value="{{ $registration_outpatient->disease }}" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Keluhan<span class="text-danger">*</span></label>
                                <input name="complaint" class="form-control" placeholder="eg: Perut Sakit" rows="4" value="{{$registration_outpatient->complaint}}" required="required"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Dokter<span class="text-danger">*</span></label>
                                <select name="doctor_id" class="select2" data-placeholder="Pilih Dokter" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor['id'] }}"{{ $doctor['id'] == $registration_outpatient->doctor_id ? 'selected=selected' : '' }}>{{ $doctor['code'] }} - {{ $doctor['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Alamat<span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" placeholder="eg: Jl. Pahlawan No 80 Block C-01" rows="5" required="required" maxlength="125">{{ $registration_outpatient->address }}</textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-right">
            <hr>

            <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>

            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan Perubahan</button>

        </div>
    </form>
</div>

@endsection

@push('js')
<script src="{{ url('assets/js/pages/registration_outpatient-add-edit.js') }}"></script>
@endpush
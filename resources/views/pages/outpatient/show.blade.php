@extends('layouts.master')

@section('title')
    Lihat Detail Registrasi Rawat Jalan
@endsection

@section('content')

@php($active = 'registration_outpatient')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Lihat Detail Registrasi Rawat Jalan</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('registration_outpatient.index') }}">Registrasi Rawat Jalan</a>
                    </li>
                    <li class="active">
                    Lihat Detail Registrasi Rawat Jalan
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
                                <input type="text" name="no_registrasi"class="form-control" value="{{ $registration_outpatient->no_registrasi }}" readonly="readonly">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">No RM<span class="text-danger">*</span></label>
                                <select disabled name="pasien_id" class="select2" readonly="readonly">
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
                                <select disabled name="poliklinik" class="select2" readonly="readonly">
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
                                        <input disabled type="text" name="tgl_periksa" class="form-control datepicker" value="{{ $registration_outpatient->tgl_periksa }}"  readonly="readonly">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Diagnosa<span class="text-danger">*</span></label>
                                        <input disabled type="text" name="disease" class="form-control" value="{{ $registration_outpatient->disease }}" readonly="readonly">
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
                                <input disabled name="complaint" class="form-control" rows="4" value="{{$registration_outpatient->complaint}}" readonly="readonly"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Dokter<span class="text-danger">*</span></label>
                                <select disabled name="doctor_id" class="select2" readonly="readonly">
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor['id'] }}"{{ $doctor['id'] == $registration_outpatient->doctor_id ? 'selected=selected' : '' }}>{{ $doctor['code'] }} - {{ $doctor['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-right">
            <hr>
            <a class="btn btn-primary btn-bordered waves-effect waves-light" href="{{route('registration_outpatient.print_data', $registration_outpatient->id)}}" target="_blank" >Print Detail Registrasi</a>
        </div>
    </form>
</div>

@endsection

@push('js')
<script src="{{ url('assets/js/pages/registration_outpatient-add-edit.js') }}"></script>
@endpush
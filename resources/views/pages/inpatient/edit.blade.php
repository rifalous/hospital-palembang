@extends('layouts.master')

@section('title')
Ubah Registrasi Rawat Inap
@endsection

@section('content')

@php($active = 'registration_inpatient')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Ubah Registrasi Rawat Inap</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('registration_inpatient.index') }}">Registrasi Rawat Inap</a>
                    </li>
                    <li class="active">
                    Ubah Registrasi Rawat Inap
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->


    <form method="post" action="{{ route('registration_inpatient.update', $registration_inpatient->id) }}" id="form-add-edit">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nomor Registrasi<span class="text-danger">*</span></label>
                                <input type="text" name="no_registrasi" placeholder="eg: 00001" class="form-control" value="{{ $registration_inpatient->no_registrasi }}" readonly="readonly" required="required">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">No RM<span class="text-danger">*</span></label>
                                <select name="pasien_id" class="select2" data-placeholder="Pilih No Rekam Medis" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($pasiens as $pasien)
                                        <option value="{{ $pasien['id'] }}"{{ $pasien['id'] == $registration_inpatient->pasien_id ? 'selected=selected' : '' }}>{{ $pasien['no_rm'] }} - {{ $pasien['name'] }} - {{ $pasien->details['identification_number'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Prosedur Masuk<span class="text-danger">*</span></label>
                                <select name="entry_procedure" class="select2" data-placeholder="Pilih Prosedur Masuk" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($entry_procedures as $entry_procedure)
                                        <option value="{{ $entry_procedure['id'] }}"{{ $entry_procedure['id'] == $registration_inpatient->entry_procedure ? 'selected=selected' : '' }}>{{ $entry_procedure['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Masuk<span class="text-danger">*</span></label>
                                        <input type="text" name="tgl_masuk" class="form-control datepicker" placeholder="yyyy-mm-dd" value="{{ $registration_inpatient->tgl_masuk }}" readonly="readonly" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Jam Masuk<span class="text-danger">*</span></label>
                                        <input type="text" name="time" class="form-control" placeholder="eg: 15:30" value="{{ $registration_inpatient->time }}" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ruangan<span class="text-danger">*</span></label>
                                <select name="room_id" class="select2" data-placeholder="Pilih Ruangan" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room['id'] }}"{{ $room['id'] == $registration_inpatient->room_id ? 'selected=selected' : '' }}>{{ $room['name'] }} - {{ $room->level['class'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Penanggung Jawab<span class="text-danger">*</span></label>
                                <select name="person_in_charge" class="select2" data-placeholder="Pilih Penanggung Jawab" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($person_in_charges as $person_in_charge)
                                        <option value="{{ $person_in_charge['id'] }}"{{ $person_in_charge['id'] == $registration_inpatient->person_in_charge ? 'selected=selected' : '' }}>{{ $person_in_charge['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Alamat<span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" placeholder="eg: Jl. Pahlawan No 80 Block C-01" rows="5" required="required">{{ $registration_inpatient->address }}</textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Dokter<span class="text-danger">*</span></label>
                                <select name="doctor_id" class="select2" data-placeholder="Pilih Dokter" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor['id'] }}"{{ $doctor['id'] == $registration_inpatient->doctor_id ? 'selected=selected' : '' }}>{{ $doctor['code'] }} - {{ $doctor['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Nama Penanggung Jawab<span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="eg: Danny" class="form-control" value="{{ $registration_inpatient->name }}" required="required">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">No Telepon<span class="text-danger">*</span></label>
                                <input type="text" name="phone" placeholder="eg: 02122xxx" class="form-control number" value="{{ $registration_inpatient->phone }}" required="required"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Diagnosa</label>
                                        <input name="disease" value="{{ $registration_inpatient->disease }}" class="form-control" placeholder="eg: Flu" rows="4" required="required" maxlength="35"></input>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Keluhan</label>
                                        <input name="complaint" value="{{ $registration_inpatient->complaint }}" class="form-control" placeholder="eg: Perut Sakit" rows="4" required="required" maxlength="35"></input>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
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
<script src="{{ url('assets/js/pages/registration_inpatient-add-edit.js') }}"></script>
@endpush
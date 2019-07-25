@extends('layouts.master')

@section('title')
Tambah Registrasi Rawat Inap 
@endsection

@section('content')

@php($active = 'registration_inpatient')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Registrasi Rawat Inap </h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('registration_inpatient.index') }}">Registrasi Rawat Inap </a>
                    </li>
                    <li class="active">
                    Tambah Registrasi Rawat Inap 
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
		</div>
	</div>
    <!-- end row -->

    
    <form method="post" action="{{ route('registration_inpatient.store') }}" id="form-add-edit">
        @csrf
                        
        <div class="row">
            <div class="col-xs-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nomor Registrasi<span class="text-danger">*</span></label>
                                <input type="text" name="no_registrasi" placeholder="eg: 00001" class="form-control"  value="{{$getCodeInpatient}}" readonly="readonly" required="required">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">No RM<span class="text-danger">*</span></label>
                                <select name="pasien_id" class="select2" data-placeholder="Pilih No Rekam Medis" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($pasiens as $pasien)
                                        <option value="{{ $pasien['id'] }}">{{ $pasien['no_rm'] }} - {{ $pasien['name'] }} - {{ $pasien->details['identification_number'] }} </option>
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
                                        <option value="{{ $entry_procedure['id'] }}">{{ $entry_procedure['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Masuk<span class="text-danger">*</span></label>
                                        <input type="text" name="tgl_masuk" class="form-control datepicker" placeholder="yyyy-mm-dd" readonly="readonly" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Jam Masuk<span class="text-danger">*</span></label>
                                        <input type="text" name="time" class="form-control" placeholder="eg: 15:30" required="required">
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
                                        <option value="{{ $room['id'] }}">{{ $room['name'] }} - {{ $room->level['class'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Penanggung Jawab<span class="text-danger">*</span></label>
                                <select name="person_in_charge" class="select2" data-placeholder="Pilih Penanggung Jawab" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($person_in_charges as $person_in_charge)
                                        <option value="{{ $person_in_charge['id'] }}">{{ $person_in_charge['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Alamat<span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" placeholder="eg: Jl. Pahlawan No 80 Block C-01" rows="5" required="required" maxlength="125"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Dokter<span class="text-danger">*</span></label>
                                <select name="doctor_id" class="select2" data-placeholder="Pilih Dokter" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor['id'] }}">{{ $doctor['code'] }} - {{ $doctor['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Nama Penanggung Jawab<span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="eg: Danny" class="form-control" required="required">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">No Telepon<span class="text-danger">*</span></label>
                                <input type="text" name="phone" placeholder="eg: 02122xxx" class="form-control number" required="required" maxlength="12"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Diagnosa<span class="text-danger">*</span></label>
                                <input name="disease" class="form-control" placeholder="eg: Perut Sakit" rows="4" required="required" maxlength="35"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 text-right">
            <hr>

            <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>
            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan</button>
        </div>
    </form>
</div>

@endsection

@push('js')
<script src="{{ url('assets/js/pages/registration_inpatient-add-edit.js') }}"></script>
@endpush
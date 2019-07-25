@extends('layouts.master')

@section('title')
	Ubah Pasien Keluar
@endsection

@section('content')

@php($active = 'patient_exits')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Ubah Pasien Keluar</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('patient_exits.index') }}">Pasien Keluar </a>
                    </li>
                    <li class="active">
                    Ubah Pasien Keluar
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
		</div>
	</div>
    <!-- end row -->

    
    <form method="post" action="{{ route('patient_exits.update', $patient_exits->id) }}" id="form-add-edit">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nomor Registrasi<span class="text-danger">*</span></label>
                                <select name="no_registrasi" class="select2" data-placeholder="Pilih Nomor Registrasi" required="required">
                                    <option></option>
                                    @foreach ($inpatients as $inpatient)
                                        <option value="{{ $inpatient->no_registrasi }}"{{ $inpatient['no_registrasi']  ==  $patient_exits->no_registrasi ? 'selected=selected' : '' }}>{{ $inpatient['no_registrasi'] }} - {{ $inpatient->pasien['name'] }} - {{ $inpatient->pasien->details['identification_number'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">No RM<span class="text-danger">*</span></label>
                                <select name="pasien_id" class="select2" data-placeholder="Pilih No Rekam Medis" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($pasiens as $pasien)
                                        <option value="{{ $pasien['id'] }}"{{ $pasien['id'] == $patient_exits->pasien_id ? 'selected=selected' : '' }}>{{ $pasien['no_rm'] }} - {{ $pasien['name'] }} - {{ $pasien->details['identification_number'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tanggal Masuk<span class="text-danger">*</span></label>
                                <input type="text" name="tgl_masuk" class="form-control datepicker" placeholder="yyyy-mm-dd" value="{{ $patient_exits->tgl_masuk }}" required="required" readonly="readonly">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                             <div class="form-group">
                                <label class="control-label">Jam Masuk<span class="text-danger">*</span></label>
                                <input type="text" name="time" class="form-control" placeholder="eg: 15:30" value="{{ $patient_exits->time }}" required="required">
                                <span class="help-block"></span>
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
                                        <option value="{{ $room['id'] }}"{{ $room['id'] == $patient_exits->room_id ? 'selected=selected' : '' }}>{{ $room['name'] }} - {{ $room->level['class'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="control-label">Diagnosis<span class="text-danger">*</span></label>
                                <input name="disease" class="form-control" placeholder="eg: Perut Sakit" rows="4" value="{{ $patient_exits->disease }}" required="required"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tanggal Keluar<span class="text-danger">*</span></label>
                                <input type="text" name="tgl_keluar" class="form-control datepicker" placeholder="yyyy-mm-dd" value="{{ $patient_exits->tgl_keluar }}" required="required" readonly="readonly">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Jam Keluar<span class="text-danger">*</span></label>
                                <input type="text" name="time_keluar" class="form-control" placeholder="eg: 15:30" value="{{ $patient_exits->time_keluar }}" required="required">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Cara Keluar<span class="text-danger">*</span></label>
                                <select name="way_out" class="select2" data-placeholder="Pilih Cara Keluar" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($way_outs as $way_out)
                                        <option value="{{ $way_out['id'] }}"{{ $way_out['id'] == $patient_exits->way_out ? 'selected=selected' : '' }}>{{ $way_out['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Keadaan Keluar<span class="text-danger">*</span></label>
                                <select name="exit_state" class="select2" data-placeholder="Pilih Keadaan Keluar" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($exit_states as $exit_state)
                                        <option value="{{ $exit_state['id'] }}"{{ $exit_state['id'] == $patient_exits->exit_state ? 'selected=selected' : '' }}>{{ $exit_state['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group">
                                <label class="control-label">Total Biaya<span class="text-danger">*</span></label>
                                <input name="total_biaya" class="form-control" placeholder="eg: Rp. 1.000.000" rows="4" value="{{ $patient_exits->total_biaya }}" required="required"></input>
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
            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan Perubahan</button>
        </div>
    </form>
</div>

@endsection

@push('js')
<script src="{{ url('assets/js/pages/patient_exits-add-edit.js') }}"></script>
@endpush
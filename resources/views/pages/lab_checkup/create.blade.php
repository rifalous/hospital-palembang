@extends('layouts.master')

@section('title')
Tambah Pemeriksaan Lab
@endsection

@section('content')

@php($active = 'registration_inpatient')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Pemeriksaan Lab </h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('lab_checkup.index') }}">Pemeriksaan Lab </a>
                    </li>
                    <li class="active">
                    Tambah Pemeriksaan Lab
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
		</div>
	</div>
    <!-- end row -->

    
    <form method="post" action="{{ route('lab_checkup.store') }}" id="form-add-edit">
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
                                <label class="control-label">Pasien<span class="text-danger">*</span></label>
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
                                <label class="control-label">Test Lab<span class="text-danger">*</span></label>
                                <select name="entry_procedure"  class="select2" multiple="multiple" data-placeholder="Pilih Test Lab" required="required">
                                    <option></option>
                                        <option value="CT Scan">CT Scan</option>
                                        <option value="MRI Scan">MRI Scan</option>
                                        <option value="Rontgent">Rontgent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Total Harga<span class="text-danger">*</span></label>
                                        <input type="text" name="tgl_masuk" class="form-control" placeholder="Rp. 100.000" readonly="readonly" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Masuk<span class="text-danger">*</span></label>
                                        <input type="text" name="time" class="form-control datepicker" placeholder="eg: yyyy-mm-dd" required="required">
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
                                <label class="control-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                <select name="person_in_charge" class="select2" data-placeholder="Pilih Penanggung Jawab" data-allow-clear="true" required="required">
                                    <option></option>
                                        <option value="Laki - Laki">Laki - Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Penanggung Jawab Lab<span class="text-danger">*</span></label>
                                <select name="doctor_id" class="select2" data-placeholder="Pilih Dokter" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor['id'] }}">{{ $doctor['code'] }} - {{ $doctor['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Catatan<span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="eg: Danny" class="form-control" required="required">
                                <span class="help-block"></span>
                            </div>
                            <div class="row">
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
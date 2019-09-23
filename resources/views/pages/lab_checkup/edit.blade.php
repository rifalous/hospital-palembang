@extends('layouts.master')

@section('title')
Edit Pemeriksaan Labolatorium
@endsection

@section('content')

@php($active = 'lab_checkup')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title"> Ubah Pemeriksaan Labolatorium </h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ url('lab_checkup') }}">Pemeriksaan Labolatorium</a>
                    </li>
                    <li class="active">
                        Ubah Pemeriksaan Labolatorium
                    </li>
                </ol>
                <div class="clearfix"></div>
                <!-- /page-title-box -->
            </div>
            <!-- /col-xs-12 -->
        </div>
        <!-- /row -->
    </div>

    <div class="row">
        <div class="col-xs-12">
            <form id="form-edit-lab_checkup" method="post"
                action="{{ route('lab_checkup.update', $lab_checkup->id) }}">
                @csrf
                @method('PUT')

                <div class="card-box">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">No Registrasi <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="inpatient_id"
                                        value="{{ $lab_checkup->inpatient->no_registrasi}}" class="form-control"
                                        id="inpatient_id" required="required">
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label for="field-1" class="control-label">Ruangan <span
                                            class="text-danger">*</span></label>
                                    <select name="room_id" disabled="disabled" readonly="readonly"
                                        class="form-control select2" data-placeholder="-- Pilih Ruangan --"
                                        required="required">
                                        <option value="">-- Pilih Ruangan --</option>
                                        @foreach ($rooms as $room)
                                        <option readonly="readonly" value="{{ $room['id'] }}"
                                            {{ $room['id'] == $lab_checkup->inpatient->room_id ? 'selected=selected' : '' }}>
                                            {{ $room['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Total Harga<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="total_amount" value="{{ $lab_checkup->total_ammount }}"
                                        id="total_amount" readonly="readonly" class="form-control"
                                        required="required">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Nama Penanggung Jawab Lab<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="person_in_charge" class="form-control" required="required"
                                        value="{{ $lab_checkup->person_in_charge }}" readonly="readonly">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama Pasien<span class="text-danger">*</span></label>
                                    <input type="text" name="pasien_id"
                                        value="{{ $lab_checkup->inpatient->pasien->name }}" readonly="readonly"
                                        class="form-control" id="pasien_id" required="required">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Nama Test Lab<span class="text-danger">*</span></label>
                                    <select name="lab_test[]" id="lab_test" multiple="multiple"
                                        class="form-control select2" data-placeholder="-- Pilih Labolatorium --"
                                        required="required">
                                        <option value="">-- Pilih Labolatorium --</option>
                                        @foreach ($labs as $data_lab)
                                            @foreach ($lab_checkup->labo as $lab)
                                            <option value="{{ $data_lab['id'] }}" {{ $data_lab['id'] == $lab->lab_id ? 'selected=selected' : '' }}>{{ $data_lab['keterangan'] }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Catatan<span class="text-danger">*</span></label>
                                    <textarea name="notes" class="form-control" rows="5" required="required"
                                        maxlength="125" readonly="readonly">{{ $lab_checkup->notes }}</textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Masuk Lab<span class="text-danger">*</span></label>
                                    <input type="text" readonly="readonly" name="registration_date"
                                        value="{{ $lab_checkup->registration_date }}" class="form-control"
                                        id="check_date" required="required">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default btn-bordered waves-effect waves-light"
                                type="reset">Reset</button>
                            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan
                                Perubahan</button>
                        </div>
                    </div>
                    <!-- /card-box -->
                </div>
            </form>
            <!-- /col-xs-12 -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

@endsection
@push('js')
<script src="{{ url('assets/js/pages/lab_checkup-edit.js') }}"></script>
@endpush

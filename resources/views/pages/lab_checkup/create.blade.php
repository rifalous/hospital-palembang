@extends('layouts.master')

@section('title')
Tambah Pemeriksaan Labolatorium
@endsection

@section('content')

@php($active = 'lab_checkup')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Tambah Pemeriksaan Labolatorium</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="#">Tambah Pemeriksaan Labolatorium</a>
                    </li>
                    <li class="active">
                        Tambah Pemeriksaan Labolatorium
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <form id="form-add-lab_checkup" method="post" action="{{ url('lab_checkup') }}">
                {{ csrf_field() }}
                <div class="card-box">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">No Registrasi <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="amount" hidden="hidden">
                                    <select name="inpatient_id" onchange="getInpatient()" class="form-control select2"
                                        data-placeholder="Pilih No Registrasi" required="required">
                                        <option value="">-- Pilih No Registrasi --</option>
                                        @foreach ($inpatient as $inpatient)
                                        <option value="{{ $inpatient->id }}">{{ $inpatient->no_registrasi }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Nama Pasien<span class="text-danger">*</span></label>
                                    <input type="text" name="pasien_id" value="" readonly="readonly"
                                        class="form-control" id="pasien_id" required="required">
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                    <input type="text" name="gender" value="" readonly="readonly" class="form-control"
                                        id="gender" required="required">
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label for="field-1" class="control-label">Ruangan <span
                                            class="text-danger">*</span></label>
                                    <select name="room_id" class="form-control select3" disabled="disabled"
                                        data-placeholder="-- Pilih Ruangan --" required="required" readonly="readonly">
                                        <option value="">-- Pilih Ruangan --</option>
                                        @foreach ($rooms as $rooms)
                                        <option value="{{ $rooms->id }}">{{ $rooms->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Nama Test Lab<span class="text-danger">*</span></label>
                                    <select name="lab_test[]" id="lab_test" multiple="multiple" class="form-control select2"
                                        data-placeholder="-- Pilih Labolatorium --" required="required">
                                        <option value="">-- Pilih Labolatorium --</option>
                                        @foreach ($labs as $lab)
                                        <option value="{{ $lab->id }}">{{ $lab->keterangan }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Total Harga<span class="text-danger">*</span></label>
                                    <input type="text" id="total_amount" value="0" name="total_amount" readonly="readonly" class="form-control" placeholder="0"
                                        required="required">
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label for="field-1" class="control-label">Tanggal Masuk Lab <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="registration_date"
                                        class="form-control datepicker" id="registration_date" required="required">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Catatan<span class="text-danger">*</span></label>
                                    <textarea name="notes" class="form-control" rows="5" required="required"
                                        maxlength="125"></textarea>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Nama Penanggung Jawab Lab<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="person_in_charge" class="form-control"
                                        required="required">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default btn-bordered waves-effect waves-light"
                                type="reset">Reset</button>
                            <button class="btn btn-primary btn-bordered waves-effect waves-light"
                                type="submit">Simpan</button>
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
<script src="{{ url('assets/js/pages/lab_checkup-add.js') }}"></script>
@endpush

@extends('layouts.pdf')

@section('title')
Lihat Detail Registrasi Rawat Inap
@endsection

@section('content')

@php($active = 'registration_inpatient')

<div class="container">
    <div class="row">
        <div class="page-title-box">
            <h4 class="page-title">Lihat Detail Registrasi Rawat Inap</h4>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end row -->

    <table style="width:100%">
        <tr>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Nomor Registrasi</label><br />
                    <input type="text" name="no_registrasi" class="form-control" value="{{ $registration_inpatient->no_registrasi }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">No RM</label><br />
                    <input type="text" name="pasien_id" class="form-control" value="{{ $registration_inpatient->pasien['no_rm'] }} - {{ $registration_inpatient->pasien['name'] }} - {{ $registration_inpatient->pasien->details['identification_number'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Prosedur Masuk</label><br />
                    <input type="text" name="entry_procedure" style="width: 90%;" class="form-control" value="{{ $registration_inpatient->entry_procedure }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <table style="width: 100%">
                        <tr>
                            <td style="width:50%">
                                <div>
                                    <label class="control-label">Tanggal Masuk</label><br />
                                    <input type="text" name="tgl_masuk" class="form-control datepicker" placeholder="yyyy-mm-dd" value="{{ $registration_inpatient->tgl_masuk }}" readonly="readonly">
                                </div>
                            </td>
                            <td style="width:50%">
                                <div>
                                    <label class="control-label">Jam Masuk</label><br />
                                    <input type="text" name="time" class="form-control" placeholder="eg: 15:30" value="{{ $registration_inpatient->time }}" readonly="readonly">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Ruangan</label><br />
                    <input type="text" name="room" style="width: 90%;" class="form-control" value="{{ $registration_inpatient->room['name'] }} - {{ $registration_inpatient->room->level['class'] }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Dokter</label><br />
                    <input type="text" name="doctor" style="width: 90%;" class="form-control" value="{{ $registration_inpatient->doctor['code'] }} - {{ $registration_inpatient->doctor['name'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Penanggung Jawab</label><br />
                    <input type="text" name="person_in_charge" style="width: 90%;" class="form-control" value="{{ $registration_inpatient->person_in_charge }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Nama Penanggung Jawab</label><br />
                    <input type="text" name="name_of_person_in_charge" style="width: 90%;" class="form-control" value="{{ $registration_inpatient->name }} - {{ $registration_inpatient->doctor['name'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:50%;height:auto;">
                <div style="width: 90%;max-height:inherit;">
                    <label class="control-label">Alamat</label><br />
                    <textarea name="alamat" style="width: 90%;min-height:100px;max-height:inherit;" class="form-control" readonly="readonly">{{$registration_inpatient->address}}</textarea>
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">No Telepon</label><br />
                    <input type="text" name="phone" style="width: 90%;" class="form-control" value="{{ $registration_inpatient->phone }}" readonly="readonly">
                </div>
                <div style="width: 90%;">
                    <table style="width: 100%">
                        <tr>
                            <td style="width:50%">
                                <div>
                                    <label class="control-label">Diagnosa</label><br />
                                    <input type="text" name="disease" class="form-control datepicker" placeholder="yyyy-mm-dd" value="{{ $registration_inpatient->disease }}" readonly="readonly">
                                </div>
                            </td>
                            <td style="width:50%">
                                <div>
                                    <label class="control-label">Keluhan</label><br />
                                    <input type="text" name="complaint" class="form-control" placeholder="eg: 15:30" value="{{ $registration_inpatient->complaint }}" readonly="readonly">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">&copy; 2019 RSUD Kabupaten Ogan Ilir</td>
        </tr>
    </table>
</div>

@endsection
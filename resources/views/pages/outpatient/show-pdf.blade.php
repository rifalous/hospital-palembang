@extends('layouts.pdf')

@section('title')
Lihat Detail Registrasi Rawat Inap
@endsection

@section('content')

@php($active = 'registration_outpatient')

<div class="container">
    <div class="row">
        <div class="page-title-box">
            <h4 class="page-title">Lihat Detail Registrasi Rawat Jalan</h4>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end row -->

    <table style="width:100%">
        <tr>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Nomor Registrasi</label><br />
                    <input type="text" name="no_registrasi" class="form-control" value="{{ $registration_outpatient->no_registrasi }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">No RM</label><br />
                    <input type="text" name="pasien_id" class="form-control" value="{{ $registration_outpatient->pasien['no_rm'] }} - {{ $registration_outpatient->pasien['name'] }} - {{ $registration_outpatient->pasien->details['identification_number'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Poliklinik</label><br />
                    <input type="text" name="poliklinik" style="width: 90%;" class="form-control" value="{{ $registration_outpatient->poliklinik }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <table style="width: 100%">
                        <tr>
                            <td style="width:50%">
                                <div>
                                    <label class="control-label">Tanggal Periksa</label><br />
                                    <input type="text" name="tgl_check" class="form-control datepicker" placeholder="yyyy-mm-dd" value="{{ $registration_outpatient->tgl_periksa }}" readonly="readonly">
                                </div>
                            </td>
                            <td style="width:50%">
                                <div>
                                    <label class="control-label">Diagnosa</label><br />
                                    <input type="text" name="disease" class="form-control" value="{{ $registration_outpatient->disease }}" readonly="readonly">
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
                    <label class="control-label">Keluhan</label><br />
                    <input type="text" name="complaint" style="width: 90%;" class="form-control" value="{{ $registration_outpatient->complaint }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Dokter</label><br />
                    <input type="text" name="doctor" style="width: 90%;" class="form-control" value="{{ $registration_outpatient->doctor['code'] }} - {{ $registration_outpatient->doctor['name'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">&copy; 2019 RSUD Kabupaten Ogan Ilir</td>
        </tr>
    </table>
</div>

@endsection
@extends('layouts.pdf')

@section('title')
Lihat Detail Pasien
@endsection

@section('content')

@php($active = 'pasien')

<div class="container">
    <div class="row">
        <div class="page-title-box">
            <h4 class="page-title">Lihat Detail Pasien</h4>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end row -->
    <table style="width:100%">
        <tr>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Nomor Registrasi</label><br />
                    <input type="text" name="no_registrasi" class="form-control" value="{{ $pasien->no_rm }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">No RM</label><br />
                    <input type="text" name="pasien_id" class="form-control" value="{{ $pasien->no_rm }} - {{ $pasien->name }} - {{ $pasien->details['identification_number'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Nama</label><br />
                    <input type="text" name="no_registrasi" class="form-control" value="{{ $pasien->name }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Alamat</label><br />
                    <input type="text" name="pasien_id" class="form-control" value="{{ $pasien->details['address'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Tanggal Lahir</label><br />
                    <input type="text" name="no_registrasi" class="form-control" value="{{ $pasien->details['date_of_birth'] }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Pekerjaan</label><br />
                    <input type="text" name="pasien_id" class="form-control" value="{{ $pasien->details['work'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Nomor Hp</label><br />
                    <input type="text" name="no_registrasi" class="form-control" value="{{ $pasien->details['phone'] }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Nomor BPJS</label><br />
                    <input type="text" name="pasien_id" class="form-control" value="{{ $pasien->details['bpjs_number'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Golongan Darah</label><br />
                    <input type="text" name="no_registrasi" class="form-control" value="{{ $pasien->details['blood_group'] }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Jenis Kelamin</label><br />
                    <input type="text" name="pasien_id" class="form-control" value="{{ $pasien->details['work'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Nama Ayah</label><br />
                    <input type="text" name="no_registrasi" class="form-control" value="{{ $pasien->details['father_name'] }}" readonly="readonly">
                </div>
            </td>
            <td style="width:50%">
                <div style="width: 90%;">
                    <label class="control-label">Nama Ibu</label><br />
                    <input type="text" name="pasien_id" class="form-control" value="{{ $pasien->details['mother_name'] }}" readonly="readonly">
                </div>
            </td>
        </tr>
    </table>
</div>

@endsection
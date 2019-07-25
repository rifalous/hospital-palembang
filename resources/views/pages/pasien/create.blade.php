@extends('layouts.master')

@section('title')
Tambah Pasien
@endsection

@section('content')

@php($active = 'pasien')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Tambah Pasien</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="{{ url('pasien') }}">Pasien</a></li>
                    <li class="active">
                    Tambah Pasien
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <form action="{{ route('pasien.store') }}" method="post" id="form-add-edit" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-9">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nomor RM <span class="text-danger">*</span></label>
                                <input type="text" name="no_rm" placeholder="eg: 00001" class="form-control" required="required" value="{{$getRegistration}}" readonly="readonly">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Alergi <span class="text-danger">*</span></label>
                                <textarea type="text" name="allergy" placeholder="eg: Obat Paracetamol" class="form-control" required="required"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nama Pasien<span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="eg: Jhony" class="form-control" required="required" maxlength="50">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Catatan Lain <span class="text-danger">*</span></label>
                                <textarea type="text" name="another_note" placeholder="eg: Pusing dan Pernah Patah Tulang Belakang" class="form-control" required="required" maxlength="150"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="gender" class="select2" data-placeholder="Pilih Jenis Kelamin" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender['id'] }}">{{ $gender['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="place" class="form-control" placeholder="eg: Jakarta" required="required" maxlength="25">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="date_of_birth" class="form-control datepicker" placeholder="yyyy-mm-dd" readonly="readonly" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="card-box">
                    <div class="form-group">
                        <label>Foto</label>
                        <div class="drag-drop text-center">
                            <p>Drag dan drop file ke sini</p>
                            <span class="block">atau</span>
                            <button class="btn btn-primary btn-bordered waves-effect waves-light" id="browse-file" type="button">Pilih File</button>
                        </div>
                        <div class="preview">
                            <div class="template">
                                <div class="remove">
                                    <button class="btn btn-danger btn-circle btn-bordered waves-effect waves-light" type="button" data-dz-remove><i class="mdi mdi-close"></i></button>
                                </div>

                                <img data-dz-thumbnail class="thumbail-preview img img-responsive img-thumbnail">

                                <div class="progress-wrapper">
                                    <div class="progress progress-striped active" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <input type="text" name="old_pic" hidden="hidden">
                    </div>

                </div>
            </div>
            <div class="col-xs-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">No Pengenal/KTP <span class="text-danger">*</span></label>
                                <input type="text" name="identification_number" placeholder="eg. 3671245xxxxx" class="form-control number" required="required" maxlength="16"></input>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Provinsi <span class="text-danger">*</span></label>
                                <select name="province_id" class="select2" data-placeholder="Pilih Provinsi" onchange="getDistrict(this.value)" required="required">
                                    <option></option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Kota <span class="text-danger">*</span></label>
                                <select name="city_id" class="select2" data-placeholder="Pilih Kota" onchange="getCity(this.value)"required="required" data-allow-clear="true"></select>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label">Kecamatan <span class="text-danger">*</span></label>
                                    <select name="district_id" class="form-control select2" data-placeholder="Pilih Kecamatan" required="required"></select>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Alamat <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" placeholder="eg: Jl. Pahlawan No 80 Block C-01" rows="13" required="required" maxlength="75"></textarea>
                                <span class="help-block"></span>
                            </div>

                        </div>

                        <!-- /col-md-4 -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Usia <span class="text-danger">*</span></label>
                                <input type="text" name="age" placeholder="eg: 17 Tahun" class="form-control number" required="required" maxlength="2">
                                <span class="help-block"></span>
                            </div>                                   
                            <div class="form-group">
                                <label class="control-label">Pekerjaan <span class="text-danger">*</span></label>
                                <select name="work" class="select2" data-placeholder="Pilih Pekerjaan" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($works as $work)
                                        <option value="{{ $work['id'] }}">{{ $work['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Pendidikan <span class="text-danger">*</span></label>
                                <select name="education" class="select2" data-placeholder="Pilih Pendidikan" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($educations as $education)
                                        <option value="{{ $education['id'] }}">{{ $education['text'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Telepon/Fax <span class="text-danger">*</span></label>
                                <input type="text" name="phone" placeholder="eg: 02122xxx" class="form-control number" required="required" maxlength="12"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama Ayah <span class="text-danger">*</span></label>
                                <input type="text" name="father_name" placeholder="eg: Dany Firmasyah" class="form-control" required="required" maxlength="25"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama Ibu <span class="text-danger">*</span></label>
                                <input type="text" name="mother_name" placeholder="eg: Dewi Anggraeni" class="form-control" required="required" maxlength="25"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama Wali <span class="text-danger">*</span></label>
                                <input type="text" name="guardian_name" placeholder="eg: Darman" class="form-control" required="required" maxlength="25"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Hubungan Keluarga <span class="text-danger">*</span></label>
                                <input type="text" name="family_relationship" placeholder="eg: Paman" class="form-control" required="required"maxlength="25"></input>
                                <span class="help-block"></span>
                            </div>      
                        </div>
                        
                        <!-- /col-md-4 -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Status Pernikahan <span class="text-danger">*</span></label>
                                <select name="status" class="select2" data-placeholder="Pilih Status Pernikahan" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($status as $status)
                                        <option value="{{ $status['id'] }}">{{ $status['text'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Golongan Darah <span class="text-danger">*</span></label>
                                <select name="blood_group" class="select2" data-placeholder="Pilih Golongan Darah" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($blood_groups as $blood_group)
                                        <option value="{{ $blood_group['id'] }}">{{ $blood_group['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Agama <span class="text-danger">*</span></label>
                                <select name="religion" class="select2" data-placeholder="Pilih Agama" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($religions as $religion)
                                        <option value="{{ $religion['id'] }}">{{ $religion['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Kode Pos <span class="text-danger">*</span></label>
                                <input type="text" name="postal_code" placeholder="eg: 42211" class="form-control number" required="required" maxlength="8"></input>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Usia Ayah <span class="text-danger">*</span></label>
                                <input type="text" name="age_father" placeholder="eg: 45 Tahun" class="form-control" required="required" maxlength="2"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Usia Ibu <span class="text-danger">*</span></label>
                                <input type="text" name="age_mother" placeholder="eg: 46 Tahun" class="form-control" required="required" maxlength="2"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Alamat Wali <span class="text-danger">*</span></label>
                                <textarea type="text" name="guardian_address" placeholder="eg: Jl. Pahlawan No 80 Block C-01" class="form-control" rows="5" required="required" maxlength="75"></textarea>
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
            
</div> <!-- container -->

@endsection


@push('js')
<script src="{{ url('assets/js/pages/territory-option-instructor.js') }}"></script>
<script src="{{ url('assets/js/pages/pasien-add-edit.js') }}"></script>
<script src="{{ url('assets/js/pages/upload-image.js') }}"></script>



@endpush
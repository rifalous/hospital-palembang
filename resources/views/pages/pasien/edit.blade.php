@extends('layouts.master')

@section('title')
    Edit Pasien
@endsection

@section('content')

@php($active = 'pasien')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit Pasien</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="{{ url('pasien') }}">Pasien</a></li>
                    <li class="active">
                        Edit Pasien
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    
    <form action="{{ route('pasien.update', $pasien->id) }}" method="post" id="form-add-edit" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-9">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nomor RM<span class="text-danger">*</span></label>
                                <input type="text" name="no_rm" placeholder="eg: 00001" class="form-control" value="{{ $pasien->no_rm }}" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Alergi<span class="text-danger">*</span></label>
                                <textarea type="text" name="allergy" placeholder="eg: Obat Paracetamol" class="form-control" required="required">{{ $pasien->allergy }}</textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nama<span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="eg: Jhony" class="form-control" value="{{ $pasien->name }}" required="required">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Catatan Lain<span class="text-danger">*</span></label>
                                <textarea type="text" name="another_note" placeholder="eg: Pusing dan Pernah Patah Tulang Belakang" class="form-control" required="required">{{ $pasien->another_note }}</textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                <select name="gender" class="select2" data-placeholder="Pilih Jenis Kelamin" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender['id'] }}" {{ $gender['id'] == $pasien->details->gender ? 'selected=selected' : '' }}>{{ $gender['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tempat Lahir<span class="text-danger">*</span></label>
                                        <input type="text" name="place" class="form-control" placeholder="eg: Jakarta" value="{{ $pasien->details->place }}" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Lahir<span class="text-danger">*</span></label>
                                        <input type="text" name="date_of_birth" class="form-control datepicker" placeholder="yyyy-mm-dd" value="{{ $pasien->details->date_of_birth }}" readonly="readonly" required="required">
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
                                <label class="control-label">Nomor Pengenal<span class="text-danger">*</span></label>
                                <input type="text" name="identification_number" placeholder="eg. 3671245xxxxx" class="form-control number" value="{{ $pasien->details->identification_number }}" required="required"></input>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Nomor BPJS</label>
                                <input type="text" name="bpjs_number" placeholder="eg. 00017257xxxxx" class="form-control number" required="required" maxlength="16" value="{{ $pasien->details->bpjs_number }}"></input>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Provinsi<span class="text-danger">*</span></label>
                                <select name="province_id" class="select2" data-placeholder="Pilih Provinsi" onchange="getDistrict(this.value)" required="required" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province['id'] }}" {{ $province['id'] == $pasien->details->province_id ? 'selected=selected' : '' }}>{{ $province['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Kota<span class="text-danger">*</span></label>
                                <select name="city_id" class="select2" data-placeholder="Pilih Kota" onchange="getCity(this.value)"required="required">
                                <option></option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city['id'] }}" {{ $city['id'] == $pasien->details->city_id ? 'selected=selected' : '' }}>{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label">Kecamatan<span class="text-danger">*</span></label>
                                    <select name="district_id" class="form-control select2" data-placeholder="Pilih Kecamatan" required="required">
                                    <option></option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district['id'] }}" {{ $district['id'] == $pasien->details->district_id ? 'selected=selected' : '' }}>{{ $district['name'] }}</option>
                                    @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Alamat</label>
                                <textarea name="address" class="form-control" placeholder="eg: Jl. Pahlawan No 80 Block C-01" rows="9" required="required">{{ $pasien->details->address }}</textarea>
                                <span class="help-block"></span>
                            </div>

                        </div>

                        <!-- /col-md-4 -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Usia<span class="text-danger">*</span></label>
                                <input type="text" name="age" placeholder="eg: 17 Tahun" class="form-control" value="{{ $pasien->details->age }}" required="required">
                                <span class="help-block"></span>
                            </div>                                   
                            <div class="form-group">
                                <label class="control-label">Pekerjaan<span class="text-danger">*</span></label>
                                <select name="work" class="select2" data-placeholder="Pilih Pekerjaan" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($works as $work)
                                        <option value="{{ $work['id'] }}" {{ $work['id'] == $pasien->details->work ? 'selected=selected' : '' }}>{{ $work['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Pendidikan<span class="text-danger">*</span></label>
                                <select name="education" class="select2" data-placeholder="Pilih Pendidikan" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($educations as $education)
                                        <option value="{{ $education['id'] }}" {{ $education['id'] == $pasien->details->education ? 'selected=selected' : '' }}>{{ $education['text'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Telepon/Fax<span class="text-danger">*</span></label>
                                <input type="text" name="phone" placeholder="eg: 02122xxx" class="form-control number" value="{{ $pasien->details->phone }}" required="required"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama Ayah</label>
                                <input type="text" id="father_name" name="father_name" placeholder="eg: Dany Firmasyah" class="form-control" value="{{ $pasien->details->father_name }}"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama Ibu</label>
                                <input type="text" id="mother_name" name="mother_name" placeholder="eg: Dewi Anggraeni" class="form-control" value="{{ $pasien->details->mother_name }}"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama Wali</label>
                                <input type="text" id="guardian_name" name="guardian_name" placeholder="eg: Darman" class="form-control"value="{{ $pasien->details->guardian_name }}"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Hubungan Keluarga<span class="text-danger">*</span></label>
                                <input type="text" name="family_relationship" placeholder="eg: Paman" class="form-control" value="{{ $pasien->details->family_relationship }}" required="required"></input>
                                <span class="help-block"></span>
                            </div>      
                        </div>
                        
                        <!-- /col-md-4 -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Status Pernikahan<span class="text-danger">*</span></label>
                                <select name="status" class="select2" data-placeholder="Pilih Status Pernikahan" data-allow-clear="true" required="required">
                                    @foreach ($status as $status)
                                        <option value="{{ $status['id'] }}" {{ $status['id'] == $pasien->details->status ? 'selected=selected' : '' }}>{{ $status['text'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Golongan Darah<span class="text-danger">*</span></label>
                                <select name="blood_group" class="select2" data-placeholder="Pilih Golongan Darah" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($blood_groups as $blood_group)
                                        <option value="{{ $blood_group['id'] }}" {{ $blood_group['id'] == $pasien->details->blood_group ? 'selected=selected' : '' }}>{{ $blood_group['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Agama<span class="text-danger">*</span></label>
                                <select name="religion" class="select2" data-placeholder="Pilih Agama" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($religions as $religion)
                                        <option value="{{ $religion['id'] }}" {{ $religion['id'] == $pasien->details->religion ? 'selected=selected' : '' }}>{{ $religion['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Kode Pos<span class="text-danger">*</span></label>
                                <input type="text" name="postal_code" placeholder="eg: 42211" class="form-control number" value="{{ $pasien->details->postal_code }}" required="required"></input>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Usia Ayah<span class="text-danger">*</span></label>
                                <input type="text" name="age_father" placeholder="eg: 45 Tahun" class="form-control" value="{{ $pasien->details->age_father }}" required="required"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Usia Ibu<span class="text-danger">*</span></label>
                                <input type="text" name="age_mother" placeholder="eg: 46 Tahun" class="form-control" value="{{ $pasien->details->age_mother }}"required="required"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Alamat Wali<span class="text-danger">*</span></label>
                                <textarea type="text" name="guardian_address" placeholder="eg: Jl. Pahlawan No 80 Block C-01" class="form-control" rows="5" required="required">{{ $pasien->details->guardian_address }}</textarea>
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
<script src="{{ url('assets/js/pages/territory-option-instructor.js') }}"></script>
<script src="{{ url('assets/js/pages/pasien-add-edit.js') }}"></script>
<script src="{{ url('assets/js/pages/upload-image.js') }}"></script>
@endpush
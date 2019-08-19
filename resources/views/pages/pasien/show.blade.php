@extends('layouts.master')

@section('title')
    Lihat Detail Pasien
@endsection

@section('content')

@php($active = 'pasien')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Lihat Detail Pasien</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="{{ url('pasien') }}">Pasien</a></li>
                    <li class="active">
                        Lihat Detail Pasien
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
                                <label class="control-label">Nomor RM</label>
                                <input type="text" name="no_rm" class="form-control" value="{{ $pasien->no_rm }}" readonly>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Alergi</label>
                                <textarea type="text" name="allergy" class="form-control" readonly>{{ $pasien->allergy }}</textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ $pasien->name }}" readonly>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Catatan Lain</label>
                                <textarea type="text" name="another_note" class="form-control" readonly>{{ $pasien->another_note }}</textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Jenis Kelamin</label>
                                <input type="text" name="gender" class="form-control" value="{{ $pasien->details->gender }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" value="{{ $pasien->details->place }}" readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Lahir</label>
                                        <input type="text" name="date_of_birth" class="form-control datepicker" value="{{ $pasien->details->date_of_birth }}" readonly="readonly" readonly>
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
                                <label class="control-label">Nomor Pengenal</label>
                                <input type="text" name="identification_number" class="form-control number" value="{{ $pasien->details->identification_number }}" readonly></input>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Nomor BPJS</label>
                                <input type="text" name="bpjs_number" class="form-control number" readonly maxlength="16" value="{{ $pasien->details->bpjs_number }}"></input>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Provinsi</label>
                                <select disabled name="province_id" class="select2" data-placeholder="Pilih Provinsi" onchange="getDistrict(this.value)" required="required" data-allow-clear="true">
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province['id'] }}" {{ $province['id'] == $pasien->details->province_id ? 'selected=selected' : '' }}>{{ $province['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Kota</label>
                                <select disabled name="city_id" class="select2" data-placeholder="Pilih Kota" onchange="getCity(this.value)"required="required">
                                    @foreach ($cities as $city)
                                        <option value="{{ $city['id'] }}" {{ $city['id'] == $pasien->details->city_id ? 'selected=selected' : '' }}>{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label">Kecamatan</label>
                                    <select disabled name="district_id" class="form-control select2" data-placeholder="Pilih Kecamatan" required="required">
                                    @foreach ($districts as $district)
                                        <option value="{{ $district['id'] }}" {{ $district['id'] == $pasien->details->district_id ? 'selected=selected' : '' }}>{{ $district['name'] }}</option>
                                    @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Alamat</label>
                                <textarea name="address" class="form-control" placeholder="eg: Jl. Pahlawan No 80 Block C-01" rows="9" readonly>{{ $pasien->details->address }}</textarea>
                                <span class="help-block"></span>
                            </div>

                        </div>

                        <!-- /col-md-4 -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Usia</label>
                                <input type="text" name="age" class="form-control" value="{{ $pasien->details->age }}" readonly>
                                <span class="help-block"></span>
                            </div>                                   
                            <div class="form-group">
                                <label class="control-label">Pekerjaan</label>
                                <input type="text" name="work" class="form-control" value="{{ $pasien->details->work }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Pendidikan</label>
                                <input type="text" name="education" class="form-control" value="{{ $pasien->details->education }}" readonly>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Telepon/Fax</label>
                                <input type="text" name="phone" placeholder="eg: 02122xxx" class="form-control number" value="{{ $pasien->details->phone }}" readonly></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama Ayah</label>
                                <input type="text" id="father_name" name="father_name" placeholder="eg: Dany Firmasyah" class="form-control" value="{{ $pasien->details->father_name }}" readonly></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama Ibu</label>
                                <input type="text" id="mother_name" name="mother_name" placeholder="eg: Dewi Anggraeni" class="form-control" value="{{ $pasien->details->mother_name }}" readonly></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama Wali</label>
                                <input type="text" id="guardian_name" name="guardian_name" placeholder="eg: Darman" class="form-control"value="{{ $pasien->details->guardian_name }}" readonly></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Hubungan Keluarga</label>
                                <input type="text" name="family_relationship" placeholder="eg: Paman" class="form-control" value="{{ $pasien->details->family_relationship }}" readonly></input>
                                <span class="help-block"></span>
                            </div>      
                        </div>
                        
                        <!-- /col-md-4 -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Status Pernikahan</label>
                                <input type="text" name="status" placeholder="eg: Paman" class="form-control" value="{{ $pasien->details->status }}" readonly></input>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Golongan Darah</label>
                                <input type="text" name="family_relationship" placeholder="eg: Paman" class="form-control" value="{{ $pasien->details->blood_group }}" readonly></input>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Agama</label>
                                <input type="text" name="religion" placeholder="eg: Paman" class="form-control" value="{{ $pasien->details->religion }}" readonly></input>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Kode Pos</label>
                                <input type="text" name="postal_code" placeholder="eg: 42211" class="form-control number" value="{{ $pasien->details->postal_code }}" readonly></input>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Usia Ayah</label>
                                <input type="text" name="age_father" placeholder="eg: 45 Tahun" class="form-control" value="{{ $pasien->details->age_father }}" readonly></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Usia Ibu</label>
                                <input type="text" name="age_mother" placeholder="eg: 46 Tahun" class="form-control" value="{{ $pasien->details->age_mother }}"readonly></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Alamat Wali</label>
                                <textarea type="text" name="guardian_address" placeholder="eg: Jl. Pahlawan No 80 Block C-01" class="form-control" rows="5" readonly>{{ $pasien->details->guardian_address }}</textarea>
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

            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit" disabled>Print Detail Pasien</button>
        </div>  
    </form>
</div> 

@endsection


@push('js')
<script src="{{ url('assets/js/pages/territory-option-instructor.js') }}"></script>
<script src="{{ url('assets/js/pages/pasien-add-edit.js') }}"></script>
<script src="{{ url('assets/js/pages/upload-image.js') }}"></script>
@endpush
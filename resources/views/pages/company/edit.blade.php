@extends('layouts.master')

@section('title')
    Ubah Perusahaan
@endsection

@section('content')

@php($active = 'company')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Ubah Perusahaan</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('company.index') }}">Perusahaan</a>
                    </li>
                    <li class="active">
                        Ubah Perusahaan
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="row">
                    <form method="post" action="{{ route('company.update', $company->id) }}" id="form-add-edit">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">ID<span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="eg: 0001" required="required" value="{{ $company->code }}">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Nama Perusahaan<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="eg: PT Perkasa Jaya" required="required" value="{{ $company->name }}">
                            </div>
                        </div>
                        

                        <div class="col-md-6">   
                            <div class="form-group">
                                <label class="control-label">Kota<span class="text-danger">*</span></label>
                                <select name="city" class="select2" data-placeholder="Pilih Kota" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city['name'] }}" {{ $city['name'] == $company->city ? 'selected=selected' : '' }}>{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Divisi<span class="text-danger">*</span></label>
                                <select name="division_id" class="select2" data-placeholder="Pilih Divisi" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($division as $division)
                                        <option value="{{ $division->id }}"{{ $division['id'] == $company->division_id ? 'selected=selected' : '' }}>{{ $division->division_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">   
                            <div class="form-group">
                                <label class="control-label">Alamat<span class="text-danger">*</span></label>
                                <textarea type="text" name="address" class="form-control" placeholder="eg: Jln Kadomas Ciekek Masjid 1 Pandeglang Banten" rows="6" required="required" >{{ $company->address }}</textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-12 text-right">
                            <hr>

                            <a class="btn btn-primary btn-bordered waves-effect waves-light" href="{{ route('company.index') }}">Batal</a>

                            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan Perubahan</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')
<script src="{{ url('assets/js/pages/company-add-edit.js') }}"></script>
@endpush
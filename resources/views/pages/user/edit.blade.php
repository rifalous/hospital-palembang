@extends('layouts.master')

@section('title')
	Ubah User
@endsection

@section('content')

@php($active = 'user')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                
                <h4 class="page-title">Ubah User</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="{{ url('user') }}">User</a></li>
                    <li class="active">
                        Ubah User
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
                <form action="{{ route('user.update', $user->id) }}" method="post" id="form-add-edit">
                    @csrf
                    @method('PUT')
                    <input type="text" name="id" value="{{ $user->id }}" hidden="hidden">

                    
                    @csrf

                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="Nama" class="form-control" required="required" value="{{ $user->name }}">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" placeholder="Email" class="form-control" required="required" value="{{ $user->email }}">
                            <span class="help-block"></span>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label">Foto</label>
                            <input type="file" name="photo" class="form-control" accept=".jpg,.jpeg" value="{{ $user->photo }}">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Divisi</label>
                                    <select name="division_id" class="select2" data-placeholder="Division" data-allow-clear="true">
                                <option></option>
                                @foreach ($division as $division)
                                    <option value="{{ $division->id }}"{{ $division['id'] == $user->division_id ? 'selected=selected' : '' }}>{{ $division->division_name }}</option>
                                @endforeach
                            </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Departemen</label>
                                    <select name="department_id" class="select2" data-placeholder="Departemen" data-allow-clear="true">
                                        @foreach ($department as $department)
                                        <option value="{{ $department->id }}" {{ $department->id == $user->department_id ? 'selected=selected' : '' }}>{{ $department->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Direksi</label>
                            <select name="direction" class="select2" data-placeholder="Pilih Direksi" data-allow-clear="true">
                                @foreach ($dir_key as $dir_key)
                                    <option value="{{ $dir_key['id'] }}"{{ $dir_key['id'] == $user->dir_key ? 'selected=selected' : '' }}>{{ $dir_key['text'] }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <hr>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label">Kata Sandi</label>
                            <input type="password" name="password" minlength="6" placeholder="Kata Sandi" class="form-control">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Ulangi Kata Sandi</label>
                            <input type="password" name="retype_password" minlength="6" placeholder="Ulangi Kata Sandi" class="form-control">
                            <span class="help-block"></span>
                            <span class="text-muted text-italic">*) Kosongkan kata sandi, jika tidak ingin mengubahnya</span>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label">Peran User</label>
                            <select name="roles[]" class="select2" data-placeholder="Peran" multiple="multiple">
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ in_array($role->id, $user->roles()->pluck('id')->toArray()) ? 'selected=selected' : '' }}>{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>


                    <div class="col-md-12 text-right">
                        <hr>

                        <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>
                        <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan Perubahan</button>

                    </div>

                    <div class="clearfix"></div>

                </form>
            </div>
        </div>
    </div>

</div> <!-- container -->

@endsection

@push('js')
<script src="{{ url('assets/js/pages/user-add-edit.js') }}"></script>
@endpush
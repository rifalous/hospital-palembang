@extends('layouts.master')
@section('title')
	Ubah Izin
@endsection

@section('content')

@php($active = 'settings/permission')
	
	<div class="container">

        <div class="row">
			<div class="col-xs-12">
				<div class="page-title-box">
                    <h4 class="page-title">Ubah Izin</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="{{ route('permission.index') }}">Izin</a>
                        </li>
                        <li class="active">
                            Ubah Izin
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
			</div>
		</div>
        <!-- end row -->


        <form action="{{ route('permission.update', $permission->id) }}" method="post" id="form-add-edit">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-content">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nama Izin<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Nama Izin" required="required" value="{{ $permission->display_name }}">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Parent</label>
                                <select name="parent_id" class="select2" data-placeholder="Pilih Parent">
                                    <option value="0">Tidak ada parent</option>
                                    @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}" {{ $parent->id == $permission->parent_id ? 'selected=selected' : '' }}>{{ $parent->display_name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Deskripsi</label>
                                <textarea name="description" placeholder="Deskripsi" class="form-control" rows="5">{{ $permission->description }}</textarea>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <hr>
                            <div class="pull-right">
                                <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>
                                <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan Perubahan</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        
    </div>

@endsection

@push('js')
    <script src="{{ url('assets/js/pages/permission-add-edit.js') }}"></script>
@endpush
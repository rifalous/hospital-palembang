@extends('layouts.master')
@section('title')
	Ubah Peran
@endsection

@section('content')

@php($active = 'settings/role')
	
	<div class="container">

        <div class="row">
			<div class="col-xs-12">
				<div class="page-title-box">
                    <h4 class="page-title">Ubah Peran</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="{{ route('role.index') }}">Peran</a>
                        </li>
                        <li class="active">
                            Ubah Peran
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
			</div>
		</div>
        <!-- end row -->


        <form action="{{ route('role.update', $role->id) }}" method="post" id="form-add-edit">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-content">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nama Peran<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Nama Peran" required="required" value="{{ $role->display_name }}">
                                <span class="help-block"></span>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Deskripsi</label>
                                <textarea name="description" placeholder="Deskripsi" class="form-control" rows="5">{{ $role->description }}</textarea>
                            </div>

                        </div>

                        <div class="col-md-12" style="margin-top: 20px">
                            <h3 class="panel-title">Izin</h3>
                            <hr>
                        </div>

                       @foreach ($permissions as $permission)
                        <div class="col-md-3">
                            <ul class="no-list">
                                <li>
                                    <div class="checkbox checkbox-primary">
                                         <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="parent parent-{{ $permission->id }}" data-value="{{ $permission->id }}" {{in_array($permission->id, $role->perms()->pluck('id')->toArray()) ? 'checked=checked' : '' }}>
                                        <label for="checkbox2">
                                            {{ $permission->display_name }}
                                        </label>
                                    </div>

                                    <ul class="no-list">
                                        @foreach ($permission->children as $children)
                                        <li>
                                            <div class="checkbox checkbox-primary">
                                                <input type="checkbox" name="permissions[]" value="{{ $children->id }}" class=" children children-{{ $permission->id}}" data-value="{{ $permission->id }}"  {{in_array($children->id, $role->perms()->pluck('id')->toArray()) ? 'checked=checked' : '' }}>
                                                <label for="checkbox2">
                                                    {{ $children->display_name }}
                                                </label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        @endforeach

                        

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
    <script src="{{ url('assets/js/pages/role-create-edit.js') }}"></script>
@endpush
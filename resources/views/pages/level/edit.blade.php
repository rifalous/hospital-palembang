@extends('layouts.master')

@section('title')
	Ubah Kelas
@endsection

@section('content')

@php($active = 'level')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Ubah Kelas</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('level.index') }}">Kelas</a>
                    </li>
                    <li class="active">
                        Ubah Kelas
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
                    <form method="post" action="{{ route('level.update', $level->id) }}" id="form-add-edit">
                        @csrf
                        @method('PUT')

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Kode Kelas<span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="Masukan Kode" required="required" value="{{$level->code}}">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Kelas<span class="text-danger">*</span></label>
                                <input type="text" name="class" class="form-control number" placeholder="eg: A12" required="required" value="{{$level->class}}" maxlength="25" >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Tarif<span class="text-danger">*</span></label>
                                <input type="text" name="tarif" class="form-control number" placeholder="Masukan Tarif" required="required" value="{{$level->tarif}}">
                                <span class="help-block"></span>
                            </div>         
                        </div>

                        <div class="col-md-12 text-right">
                            <hr>

                            <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>

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
<script src="{{ url('assets/js/pages/level-add-edit.js') }}"></script>
@endpush
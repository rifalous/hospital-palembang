@extends('layouts.master')

@section('title')
Tambah Ruangan
@endsection

@section('content')

@php($active = 'room')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Ruangan</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('room.index') }}">Ruangan</a>
                    </li>
                    <li class="active">
                    Tambah Ruangan
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
                    <form method="post" action="{{ route('room.store') }}" id="form-add-edit">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kode Ruangan<span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="eg: A1234" required="required" maxlength="8">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Nama Ruangan<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="eg: Siliwangi" required="required" maxlength="25">
                                <span class="help-block"></span>
                            </div>

                            
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Kelas<span class="text-danger">*</span></label>
                                    <select name="level_id" class="select2" data-placeholder="Pilih Kelas" data-allow-clear="true" required="required">
                                        <option></option>
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->code }} - {{ $level->class }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Jumlah Tempat Tidur<span class="text-danger">*</span></label>
                                            <input type="text" name="total_place_number" placeholder="eg: 10" class="form-control number" required="required" value="0" >
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label class="control-label">Tempat Tidur Tersedia<span class="text-danger">*</span></label>
                                            <input type="text" name="place_resource" placeholder="eg: 10" class="form-control number" required="required" value="0" >
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <hr>

                            <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>

                            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')
<script src="{{ url('assets/js/pages/room-add-edit.js') }}"></script>
@endpush
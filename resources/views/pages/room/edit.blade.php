@extends('layouts.master')

@section('title')
	Ubah Ruangan
@endsection

@section('content')

@php($active = 'room')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Ubah Ruangan</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('room.index') }}">Ruangan</a>
                    </li>
                    <li class="active">
                    Ubah Ruangan
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
                    <form method="post" action="{{ route('room.update', $room->id) }}" id="form-add-edit">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kode Ruangan<span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="Masukan Kode" required="required" value="{{$room->code}}">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Nama Ruangan<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama" required="required" value="{{$room->name}}">
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
                                            <option value="{{ $level['id'] }}"{{ $level['id'] == $room->level_id ? 'selected=selected' : '' }}>{{ $level['code'] }} - {{ $level['class'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Jumlah Tempat Tidur<span class="text-danger">*</span></label>
                                            <input type="number" name="total_place_number" placeholder="Masukan Jumlah Tempat Tidur" class="form-control datepicker" required="required" value="{{$room->total_place_number}}" >
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Tempat Tidur Tersedia<span class="text-danger">*</span></label>
                                            <input type="number" name="place_resource" placeholder="Masukan Tempat Tidur Tersedia" class="form-control datepicker" required="required" value="{{$room->place_resource}}">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
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
<script src="{{ url('assets/js/pages/room-add-edit.js') }}"></script>
@endpush
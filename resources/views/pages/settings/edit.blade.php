@extends('layouts.master')

@section('title')
	Tambah Pengaturan Baru
@endsection

@section('content')

@php($active = 'settings')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Pengaturan Baru</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('settings.index') }}">Pengaturan</a>
                    </li>
                    <li class="active">
                        Tambah Pengaturan Baru
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
                    <form method="post" action="{{ route('settings.update', $setting->id) }}" id="form-add-edit">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Kunci <span class="text-danger">*</span></label>
                                <input type="text" name="key" class="form-control" placeholder="Kunci" required="required" value="{{ $setting->key }}">
                                <span class="help-block"></span>
                            </div>


                            <div class="form-group">
                                <label class="control-label">Nilai</label>
                                <textarea rows="5" placeholder="Nilai" name="value" class="form-control">{{ $setting->value }}</textarea>
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
<script src="{{ url('assets/js/pages/settings-add-edit.js') }}"></script>
@endpush
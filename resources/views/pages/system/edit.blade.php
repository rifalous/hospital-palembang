@extends('layouts.master')

@section('title')
	System
@endsection

@section('content')

@php($active = 'system')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Edit System Master</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('system.index') }}">System Master</a>
                    </li>
                    <li class="active">
                        Edit System Master
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
                    <form method="post" action="{{ route('system.update', $system->id) }}" id="form-add-edit">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">System Type<span class="text-danger">*</span></label>
                                <input type="text" name="system_type" class="form-control" placeholder="System Type" required="required" value="{{ $system->system_type }}">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">System Code<span class="text-danger">*</span></label>
                                <input type="text" name="system_code" class="form-control" placeholder="System Code" required="required" value="{{ $system->system_code }}">
                                <span class="help-block"></span>
                            </div>


                            <div class="form-group">
                                <label class="control-label">System Value<span class="text-danger">*</span></label>
                                <input type="text" name="system_val" class="form-control" placeholder="System Value" required="required" value="{{ $system->system_val }}">
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
<script src="{{ url('assets/js/pages/system-add-edit.js') }}"></script>
@endpush
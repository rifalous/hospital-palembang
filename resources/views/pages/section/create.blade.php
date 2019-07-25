@extends('layouts.master')

@section('title')
	Create Section
@endsection

@section('content')

@php($active = 'Section')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Create Section</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('section.index') }}">Section</a>
                    </li>
                    <li class="active">
                        Create Section
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
                    <form method="post" action="{{ route('section.store') }}" id="form-add-edit">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Section Code <span class="text-danger">*</span></label>
                                <input type="text" name="section_code" class="form-control" placeholder="Section Code" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Section Name <span class="text-danger">*</span></label>
                                <input type="text" name="section_name" class="form-control" placeholder="Section Name" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Department Name<span class="text-danger">*</span></label>
                                <select name="department_id" class="select2" data-placeholder="Select Department" required="required">
                                    <option></option>
                                    @foreach ($department as $department)
                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <hr>

                            <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>

                            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Save</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')
<script src="{{ url('assets/js/pages/section-add-edit.js') }}"></script>
@endpush
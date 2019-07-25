@extends('layouts.master')

@section('title')
	Create Customer
@endsection

@section('content')

@php($active = 'customer')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Create Customer</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('customer.index') }}">Customer</a>
                    </li>
                    <li class="active">
                        Create Customer
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
                    <form method="post" action="{{ route('customer.store') }}" id="form-add-edit">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Customer Code <span class="text-danger">*</span></label>
                                <input type="text" name="customer_code" class="form-control" placeholder="Customer Code" required="required">
                                <span class="help-block"></span>
                            </div>


                            <div class="form-group">
                                <label class="control-label">Customer Name<span class="text-danger">*</span></label>
                                <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" required="required">
                                <!-- <textarea rows="5" placeholder="Division Name" name="division_name" class="form-control"></textarea> -->
                            </div>

                            <div class="form-group">
                                <label class="control-label">Address</label>
                                <!-- <input type="text" name="customer_address" class="form-control" placeholder="Customer Address" required="required"> -->
                                <textarea rows="3" placeholder="Customer Address" name="customer_address" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <input type="text" name="customer_phone" class="form-control" placeholder="Customer Phone">
                                <!-- <textarea rows="5" placeholder="Division Name" name="division_name" class="form-control"></textarea> -->
                            </div>

                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="text" name="customer_email" class="form-control" placeholder="Customer Email">
                                <!-- <textarea rows="5" placeholder="Division Name" name="division_name" class="form-control"></textarea> -->
                            </div>
                        
                            <div class="form-group">
                                <label class="control-label">Website</label>
                                <input type="text" name="customer_website" class="form-control" placeholder="Customer website">
                                <!-- <textarea rows="5" placeholder="Division Name" name="division_name" class="form-control"></textarea> -->
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">PIC Name</label>
                                <input type="text" name="customer_pic_name" class="form-control" placeholder="Customer PIC Name">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">PIC Phone</label>
                                <input type="text" name="customer_pic_phone" class="form-control" placeholder="Customer PIC Phone">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">PIC Email</label>
                                <input type="text" name="customer_pic_email" class="form-control" placeholder="Customer PIC Email">
                                <span class="help-block"></span>
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
<script src="{{ url('assets/js/pages/customer-add-edit.js') }}"></script>
@endpush
@extends('layouts.master')

@section('title')
	Ubah Supplier
@endsection

@section('content')

@php($active = 'supplier')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Ubah Supplier</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('supplier.index') }}">Supplier</a>
                    </li>
                    <li class="active">
                        Ubah Supplier
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
                    <form method="post" action="{{ route('supplier.update', $supplier->id) }}" id="form-add-edit">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kode Supplier<span class="text-danger">*</span></label>
                                <input type="text" name="supplier_code" class="form-control" placeholder="Kode Supplier" required="required" value="{{ $supplier->supplier_code }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nama Supplier<span class="text-danger">*</span></label>
                                <input type="text" name="supplier_name" class="form-control" placeholder="Nama Supplier" required="required" value="{{ $supplier->supplier_name }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Alamat Supplier<span class="text-danger">*</span></label>
                                <textarea rows="3" placeholder="Supplier Address" name="supplier_address" class="form-control" required="required">{{ $supplier->supplier_address }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">No Telepon</label>
                                    <input type="text" name="supplier_phone" class="form-control number" placeholder="Supplier Phone" value="{{ $supplier->supplier_phone }}" maxlength="12">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" name="supplier_email" class="form-control" placeholder="Supplier Email" value="{{ $supplier->supplier_email }}">
                                </div>
                            
                                <div class="form-group">
                                    <label class="control-label">Website</label>
                                    <input type="text" name="supplier_website" class="form-control" placeholder="Supplier website" value="{{ $supplier->supplier_website }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama PIC</label>
                                    <input type="text" name="supplier_pic_name" class="form-control" placeholder="Nama PIC Supplier" value="{{ $supplier->supplier_pic_name }}">
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">No Telepon PIC</label>
                                    <input type="text" name="supplier_pic_phone" class="form-control number" placeholder="No Telepon PIC Supplier" value="{{ $supplier->supplier_pic_phone }}" maxlength="12">
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Email PIC</label>
                                    <input type="email" name="supplier_pic_email" class="form-control" placeholder="Email PIC Supplier" value="{{ $supplier->supplier_pic_email }}">
                                    <span class="help-block"></span>
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
<script src="{{ url('assets/js/pages/supplier-add-edit.js') }}"></script>
@endpush
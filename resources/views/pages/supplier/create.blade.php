@extends('layouts.master')

@section('title')
	Tambah Supplier
@endsection

@section('content')

@php($active = 'supplier')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Supplier</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('supplier.index') }}">Supplier</a>
                    </li>
                    <li class="active">
                        Tambah Supplier
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
                    <form method="post" action="{{ route('supplier.store') }}" id="form-add-edit">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kode Supplier<span class="text-danger">*</span></label>
                                <input type="text" name="supplier_code" class="form-control" placeholder="eg: 001" required="required">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nama Supplier<span class="text-danger">*</span></label>
                                <input type="text" name="supplier_name" class="form-control" placeholder="eg: Formaltech" required="required">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Alamat Supplier<span class="text-danger">*</span></label>
                                <textarea rows="3" placeholder="eg: Jln Karapitan No 41 Bandung" name="supplier_address" class="form-control" required="required"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">No Telepon</label>
                                    <input type="text" name="supplier_phone" class="form-control number" placeholder="081288xxxxxx" maxlength="12">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" name="supplier_email" class="form-control" placeholder="eg: formaltech@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Website</label>
                                    <input type="text" name="supplier_website" class="form-control" placeholder="eg: formaltech.com">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama PIC</label>
                                    <input type="text" name="supplier_pic_name" class="form-control" placeholder="eg: Denny">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">No Telepon PIC</label>
                                    <input type="text" name="supplier_pic_phone" class="form-control number" placeholder="eg: 08128847xxx" maxlength="12">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email PIC</label>
                                    <input type="email" name="supplier_pic_email" class="form-control" placeholder="eg: formaltech@gmail.com">
                                    <span class="help-block"></span>
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
<script src="{{ url('assets/js/pages/supplier-add-edit.js') }}"></script>
@endpush
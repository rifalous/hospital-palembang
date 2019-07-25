@extends('layouts.master')

@section('title')
	Ubah Bahan & Obat
@endsection

@section('content')

@php($active = 'material')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Ubah Bahan & Obat</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('material.index') }}">Bahan & Obat</a>
                    </li>
                    <li class="active">
                        Ubah Bahan & Obat
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
                    <form method="post" action="{{ route('material.update', $material->id) }}" id="form-add-edit">
                        @csrf
                        @method('PUT')

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Kode Obat<span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="Masukan Kode" required="required" value="{{$material->code}}">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Golongan<span class="text-danger">*</span></label>
                                <select name="group" class="select2" data-placeholder="Pilih Golongan" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group['id'] }}" {{ $group['id'] == $material->group ? 'selected=selected' : '' }}>{{ $group['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label">Isi<span class="text-danger">*</span></label>
                                <input type="text" name="fill_in" class="form-control number" placeholder="eg: 100 " value="{{$material->fill_in}}" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Harga Beli<span class="text-danger">*</span></label>
                                <input type="text" name="purchase_price" id="purchase_price" class="form-control" placeholder="Masukan Harga Beli" required="required" value="{{$material->purchase_price}}" onchange="persen1()">
                                <span class="help-block"></span>
                            </div>
                             <div class="form-group">
                                <label class="control-label">Harga Resep<span class="text-danger">*</span></label>
                                <input type="text" name="recipe_prices" id="recipe_prices" class="form-control" placeholder="Masukan Harga Resep" required="required" value="{{$material->recipe_prices}}" onchange="persen2()">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Nama Obat<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama" required="required" value="{{$material->name}}">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Jenis Obat<span class="text-danger">*</span></label>
                                <select name="type" class="select2" data-placeholder="Pilih Jenis Obat" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type['id'] }}" {{ $type['id'] == $material->type ? 'selected=selected' : '' }}>{{ $type['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Satuan<span class="text-danger">*</span></label>
                                <input type="text" name="unit" class="form-control" placeholder="eg: cc " value="{{$material->unit}}" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Harga Bebas<span class="text-danger">*</span></label>
                                <input type="text" name="selling_price" id="selling_price" class="form-control" placeholder="Masukan Harga Bebas" required="required" value="{{$material->selling_price}}" onchange="persen1()">  
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Persen Laba<span class="text-danger">*</span></label>
                                <input type="text" name="profit_persen" id="profit_persen" class="form-control" placeholder="Masukan Persen Laba" required="required" value="{{$material->profit_persen}}" readonly="readonly" >
                                <span class="help-block"></span>
                            </div>
                            
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Kemasan<span class="text-danger">*</span></label>
                                <input type="text" name="packaging" class="form-control" placeholder="Masukan Kemasan" required="required" value="{{$material->packaging}}">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Supplier<span class="text-danger">*</span></label>
                                <select name="supplier_id" class="select2" data-placeholder="Pilih Supplier" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $supplier->id == $material->supplier_id ? 'selected=selected' : '' }}>{{ $supplier->supplier_code }} - {{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Min Stok<span class="text-danger">*</span></label>
                                <input type="text" name="minimum_stock" class="form-control number" placeholder="eg: 20 " value="{{$material->minimum_stock}}" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Persen Laba<span class="text-danger">*</span></label>
                                <input type="text" name="profit" id="profit" class="form-control" placeholder="Masukan Persen Laba" required="required" value="{{$material->profit}}" readonly="readonly" >
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Expire Date<span class="text-danger">*</span></label>
                                <input type="text" name="expire_date" placeholder="Masukan Expire Date" class="form-control datepicker" required="required" value="{{$material->expire_date}}" readonly="readonly">
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
<script src="{{ url('assets/js/pages/material-add-edit.js') }}"></script>
@endpush
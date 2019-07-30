@extends('layouts.master')

@section('title')
	Tambah Pembayaran
@endsection

@section('content')

@php($active = 'payment')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Pembayaran</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('payment.index') }}">Pembayaran</a>
                    </li>
                    <li class="active">
                        Tambah Pembayaran
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
		</div>
	</div>
    <!-- end row -->

    
    <form method="post" action="{{ route('payment.store') }}" id="form-add-edit">
        @csrf
                        
        <div class="row">
            <div class="col-xs-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                  <label for="field-1" class="control-label">No Registrasi<span class="text-danger">*</span></label>
                                  <select name="outpatient_id" class="form-control select2 outpatient-id" data-placeholder="Pilih No Registrasi" required="required">
                                  </select>
                                  <span class="help-block"></span>
                                </div>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Total Biaya<span class="text-danger">*</span></label>
                                <input type="text" name="total_biaya" id="total_biaya" readonly="readonly" class="form-control number" placeholder="eg: Rp. 1.000.000" rows="4" required="required"></input>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Sisa Pembayaran<span class="text-danger">*</span></label>
                                <input type="text" name="sisa_pembayaran" id="sisa_pembayaran" class="form-control number" placeholder="eg: Rp. 1.000.000" rows="4" required="required" readonly="readonly"></input>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Alamat<span class="text-danger">*</span></label>
                                <textarea type="text" name="address" class="form-control" placeholder="eg: Jalan Jenderal Sudirman Cimahi Tengah " rows="6" required="required" maxlength="20"></textarea>
                            </div> 
                        </div>

                        

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Nama Pasien<span class="text-danger">*</span></label>
                                <input type="text" name="pasien_id" readonly="readonly"  class="form-control" placeholder="Nama Pasien" rows="4" required="required" readonly="readonly"></input>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Jumlah Dibayar<span class="text-danger">*</span></label>
                                <input type="text" name="jumlah_dibayar"  id="jumlah_dibayar" class="form-control number" placeholder="eg: Rp. 1.000.000" rows="4" required="required"></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Sisa Tagihan<span class="text-danger">*</span></label>
                                <input type="text" name="sisa_tagihan" id="sisa_tagihan" onChange="updatePrice()" class="form-control" placeholder="0" rows="4" required="required" readonly="readonly"></input>
                                <span class="help-block"></span>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label">Keterangan</label>
                                <textarea type="text" name="ket" class="form-control" placeholder="eg: Keterangan" rows="6" maxlength="20"></textarea>
                            </div> 
                        </div>
                        

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Tanggal Bayar <span class="text-danger">*</span></label>
                                <input type="text" name="tgl_bayar"  value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control datepicker" placeholder="yyyy-mm-dd" readonly="readonly" required="required">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Diskon</label>
                                <input type="text" name="diskon" id="diskon" class="form-control number" placeholder="eg: 10 %" rows="4" ></input>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Pembayaran<span class="text-danger">*</span></label>
                                <select name="payment" class="select2" data-placeholder="Pilih Pembayaran" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($payments as $payment)
                                        <option value="{{ $payment['id'] }}">{{ $payment['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Jenis Diskon</label>
                                <select name="discount" class="select2" data-placeholder="Pilih Jenis Diskon" data-allow-clear="true" >
                                    <option></option>
                                    @foreach ($discounts as $discount)
                                        <option value="{{ $discount['id'] }}">{{ $discount['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 text-right">
            <hr>

            <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>
            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan</button>
        </div>
    </form>
</div>

@endsection

@push('js')
<script src="{{ url('assets/js/pages/payment-add-edit.js') }}"></script>
<script src="{{ url('assets/js/pages/payment-count.js') }}"></script>
@endpush
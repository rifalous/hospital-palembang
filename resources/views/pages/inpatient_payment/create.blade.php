@extends('layouts.master')

@section('title')
	Tambah Pembayaran
@endsection

@section('content')

@php($active = 'inpatient_payment')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Pembayaran</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('inpatient_payment.index') }}">Pembayaran</a>
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

    
    <form method="post" action="{{ route('inpatient_payment.store') }}" id="form-add-edit">
        @csrf
                        
        <div class="row">
            <div class="col-xs-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nomor Registrasi <span class="text-danger">*</span></label>
                                <select name="no_registrasi" class="select2" data-placeholder="Pilih Nomor Registrasi" required="required">
                                    <option></option>
                                    @foreach ($inpatients as $inpatient)
                                        <option value="{{ $inpatient['no_registrasi'] }}">{{ $inpatient['no_registrasi'] }} - {{ $inpatient->pasien['name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">No RM <span class="text-danger">*</span></label>
                                <select name="pasien_id" class="select2" data-placeholder="Pilih No Rekam Medis" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($pasiens as $pasien)
                                        <option value="{{ $pasien['no_rm'] }}">{{ $pasien['no_rm'] }} - {{ $pasien['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Ruangan <span class="text-danger">*</span></label>
                                <select name="room_id" class="select2" data-placeholder="Pilih Ruangan" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room['id'] }}">{{ $room['name'] }} - {{ $room->level['class'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>   

                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="control-label">Total Biaya<span class="text-danger">*</span></label>
                                <input type="text" name="total_biaya" id="total_biaya" class="form-control" placeholder="eg: Rp. 1.000.000" rows="4" required="required"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="control-label">Sisa Tagihan</label>
                                <input type="text" name="sisa_tagihan" id="sisa_tagihan" onChange="updatePrice()" class="form-control" placeholder="0" rows="4" required="required" readonly="readonly"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="control-label">Jumlah Dibayar<span class="text-danger">*</span></label>
                                <input type="text" name="jumlah_dibayar"  id="jumlah_dibayar" class="form-control" placeholder="eg: Rp. 1.000.000" rows="4" required="required"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tanggal Bayar <span class="text-danger">*</span></label>
                                <input type="text" name="tgl_bayar" class="form-control datepicker" placeholder="yyyy-mm-dd" required="required" readonly="readonly">
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="control-label">Diskon</label>
                                <input type="text" name="diskon" id="diskon" class="form-control" placeholder="eg: 10 %" rows="4" ></input>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
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

                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="control-label">Sisa Pembayaran</label>
                                <input type="text" name="sisa_pembayaran" id="sisa_pembayaran" class="form-control" placeholder="eg: Rp. 1.000.000" rows="4" required="required" readonly="readonly"></input>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="control-label">Pembayaran<span class="text-danger">*</span></label>
                                <select name="payment" class="select2" data-placeholder="Pilih Pembayaran" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($payments as $payment)
                                        <option value="{{ $payment['id'] }}">{{ $payment['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">   
                            <div class="form-group">
                                <label class="control-label">Alamat<span class="text-danger">*</span></label>
                                <textarea type="text" name="address" class="form-control" placeholder="eg: Jalan Jenderal Sudirman Cimahi Tengah " rows="6" required="required" maxlength="125"></textarea>
                            </div> 
                        </div>
                        <div class="col-md-6">   
                            <div class="form-group">
                                <label class="control-label">Keterangan</label>
                                <textarea type="text" name="ket" class="form-control" placeholder="eg: Keterangan" rows="6" maxlength="125"></textarea>
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
<script src="{{ url('assets/js/pages/inpatient_payment-add-edit.js') }}"></script>
<script src="{{ url('assets/js/pages/inpatient_payment-count.js') }}"></script>
@endpush
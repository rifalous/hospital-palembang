@extends('layouts.master')

@section('title')
  Tambah Pemeriksaan 
@endsection

@section('content')

@php($active = 'examination_inpatient')


<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="page-title-box">
          <h4 class="page-title"> Tambah Pemeriksaan Rawat Inap </h4>
          <ol class="breadcrumb p-0 m-0">
              <li>
                  <a href="{{ url('examination_inpatient') }}">Pemeriksaan Rawat Inap</a>
              </li>
              <li class="active">
                  Tambah Pemeriksaan Rawat Inap
              </li>
          </ol>
          <div class="clearfix"></div>
          <!-- /page-title-box -->
      </div>
      <!-- /col-xs-12 -->
    </div>
    <!-- /row -->
  </div>

  <div class="row">
    <div class="col-xs-12">
     <form id="form-add-examination_inpatient" method="post" action="{{ url('examination_inpatient') }}">
        {{ csrf_field() }}
        <div class="card-box">
          <div class="modal-body">
                  <div class="row">
                      <div class="col-md-6">
                            <div class="form-group">
                              <label for="field-1" class="control-label">No Registrasi <span class="text-danger">*</span></label>
                              <input type="text" name="amount_action" hidden="hidden">
                              <input type="text" name="amount" hidden="hidden" >
                              <input type="text" name="amount_material" hidden="hidden">
                              <input type="text" name="amount_lab" hidden="hidden">
                              <select name="inpatient_id" class="form-control select2" data-placeholder="Pilih No Registrasi" required="required">
                              <option value="">-- Pilih No Registrasi --</option>
                              @foreach ($inpatient as $inpatient)
                                <option value="{{ $inpatient->id }}">{{ $inpatient->no_registrasi }} - {{ $inpatient->pasien->name }} </option>
                              @endforeach
                              </select>
                              <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                              <label for="field-1" class="control-label">Ruangan <span class="text-danger">*</span></label>
                              <select name="room_id" class="form-control select2" data-placeholder="-- Pilih Ruangan --" required="required">
                                <option value="">-- Pilih Ruangan --</option>
                              </select>
                              <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                              <label class="control-label">Nama<span class="text-danger">*</span></label>
                              <input type="text" name="pasien_id" value="" readonly="readonly" class="form-control" id="pasien_id" required="required">
                              <span class="help-block"></span>
                            </div>
                              
                            <div class="form-group">
                              <label class="control-label">Total Biaya Tindakan<span class="text-danger">*</span></label>
                              <input type="text" name="amount_action" value="" readonly="readonly" class="form-control" id="total_action" required="required">
                              <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Total Biaya Laboratorium<span class="text-danger">*</span></label>
                                <input type="text" name="amount_lab" value="" readonly="readonly" class="form-control" id="total_action" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Total Pembayaran<span class="text-danger">*</span></label>
                                <input type="text" name="amount" value="" id="total_pembayaran" readonly="readonly" class="form-control" required="required">
                                <span class="help-block"></span>
                            </div>
	                        </div>
                      
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label">Tanggal Masuk<span class="text-danger">*</span></label>
                            <input type="text" name="registration_date" class="form-control datepicker " placeholder="yyyy-mm-dd" required="required">
                            <span class="help-block"></span>
                        </div>
                        
                          <div class="form-group">
                            <label class="control-label">Kelas<span class="text-danger">*</span></label>
                            <select name="class_id" class="form-control select2" data-placeholder="-- Pilih Kelas --" required="required">
                              <option value="">-- Pilih Kelas --</option>
                              @foreach ($class  as $class)
                                <option value="{{ $class->id }}">{{ $class->code }} | {{ $class->class }}</option>
                              @endforeach 
                            </select>
                            <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                            <label for="field-1" class="control-label">Dokter <span class="text-danger">*</span></label>
                            <input type="text" name="doctor_name" placeholder="eg. Indra" readonly="readonly" class="form-control" id="doctor_id" required="required">
                            <span class="help-block"></span>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Total Biaya Obat<span class="text-danger">*</span></label>
                              <input type="text" name="amount_material" value="" readonly="readonly" class="form-control" id="total_material" required="required" value="0">
                              <span class="help-block"></span>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Tanggal Pemeriksaan<span class="text-danger">*</span></label>
                              <input type="text" name="check_date" class="form-control datepicker " placeholder="yyyy-mm-dd" required="required">
                              <span class="help-block"></span>
                          </div>
                      </div>
	                </div>

	                    <div class="col-md-6">
	                      <!-- <small class="text-muted">Daftar Unit Kompetensi</small> -->
	                    </div>
	                    <div class="col-md-6 text-right">
	                      <button class="btn btn-success btn-bordered waves-effect waves-light" data-toggle="tooltip" data-original-title="Tambah Baris" onclick="onAddRow()" type="button"><i class="mdi mdi-plus"></i></button>
	                    </div>

	                <div class="row mt-20">
                    <div class="col-md-12" style="padding-top: 10px">
                      <table class="table table-bordered" id="details-inpatient-table">
                        <thead>
                          <tr>
                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Tindakan</th>
                            <th class="text-center" colspan="4">Tindakan Medis</th>
                            <th  rowspan="2" style="width: 50px"></th>
                          </tr>
                          <tr>
                            <th class="text-center">Biaya</th>
                            <th class="text-center">Banyak</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Dokter</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr id="empty-row">
                            <td colspan="6" class="text-center">Tidak ada data</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <!-- <small class="text-muted">Daftar Unit Kompetensi</small> -->
                      </div>
                      <div class="col-md-6 text-right">
                        <button class="btn btn-success btn-bordered waves-effect waves-light" data-toggle="tooltip" data-original-title="Tambah Baris" onclick="onAddRow1()" type="button"><i class="mdi mdi-plus"></i></button>
                      </div>
                    </div>

                  <div class="row mt-20">
                    <div class="col-md-12" style="padding-top: 10px">
                      <table class="table table-bordered" id="details-inpatient-material">
                        <thead>
                          <tr>
                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Bahan/Obat</th>
                            <th class="text-center" colspan="6">Biaya Bahan/Obat</th>
                            <th  rowspan="2" style="width: 50px"></th>


                          </tr>
                          <tr>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Waktu</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Banyak</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Pemberi Obat</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr id="empty-row-medicine">
                            <td colspan="8" class="text-center">Tidak ada data</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <!-- <small class="text-muted">Daftar Unit Kompetensi</small> -->
                    </div>
                    <div class="col-md-6 text-right">
                      <button class="btn btn-success btn-bordered waves-effect waves-light" data-toggle="tooltip" data-original-title="Tambah Baris" onclick="onAddRow2()" type="button"><i class="mdi mdi-plus"></i></button>
                    </div>
                  </div>

                  <div class="row mt-20">
                    <div class="col-md-12" style="padding-top: 10px">
                      <table class="table table-bordered" id="details-inpatient-lab">
                        <thead>
                          <tr>
                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Laboratorium</th>
                            <th class="text-center" colspan="3">Biaya Laboratorium</th>
                            <th  rowspan="2" style="width: 50px"></th>
                          </tr>
                          <tr>
                            <th class="text-center">Hasil</th>
                            <th class="text-center">Biaya</th>
                            <th class="text-center">Penanggung Jawab</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr id="empty-row-lab">
                            <td colspan="8" class="text-center">Tidak ada data</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <input type="text" name="last_index" hidden="hidden" value="0">
                  <input type="text" name="last_index_2" hidden="hidden" value="0">
                  <input type="text" name="last_index_3" hidden="hidden" value="0">

                  <hr>
	            </div>
	            <div class="modal-footer">
	                <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>
                      <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan</button>
	            </div>
	        </div>
    	<!-- /card-box -->
	    </div>
     </form>
      <!-- /col-xs-12 -->
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>

@endsection

@push('js')
<script src="{{ url('assets/js/pages/examination_inpatient-add.js') }}"></script>
@endpush
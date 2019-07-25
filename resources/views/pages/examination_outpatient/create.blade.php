@extends('layouts.master')

@section('title')
  Tambah Pemeriksaan Rawat Jalan
@endsection

@section('content')

@php($active = 'examination_outpatient')


<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="page-title-box">
          <h4 class="page-title"> Tambah Pemeriksaan Rawat Jalan </h4>
          <ol class="breadcrumb p-0 m-0">
              <li>
                  <a href="{{ url('examination_outpatient') }}">Pemeriksaan Rawat Jalan</a>
              </li>
              <li class="active">
                  Tambah Pemeriksaan Rawat Jalan
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
     <form id="form-add-examination_outpatient" method="post" action="{{ url('examination_outpatient') }}">
        {{ csrf_field() }}
        <div class="card-box">
          <div class="modal-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="field-1" class="control-label">No Registrasi <span class="text-danger">*</span></label>
                              <select name="outpatient_id" id="outpatient" class="form-control select2 outpatient-id" data-placeholder="Pilih No Registrasi" required="required">
                              </select>
                              <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                              <label class="control-label">Nama<span class="text-danger">*</span></label>
                              <input type="text" name="pasien_id" placeholder="eg. Ega" readonly="readonly" class="form-control" id="pasien_id" required="required">
                              <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                              <label class="control-label">Total Biaya Tindakan<span class="text-danger">*</span></label>
                              <input type="text" name="amount_action" readonly="readonly" class="form-control" id="total_action" required="required" value="0">
                              <span class="help-block"></span>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Total Pembayaran<span class="text-danger">*</span></label>
                              <input type="text" name="amount" id="total_pembayaran" readonly="readonly" class="form-control" required="required" value="0">
                              <span class="help-block"></span>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Tanggal Periksa<span class="text-danger">*</span></label>
                              <input type="text" name="registration_date" placeholder="dd-mm-yyyy" class="form-control" readonly="readonly" id="check_date" required="required" readonly="readonly">
                              <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                              <label class="control-label">Dokter<span class="text-danger">*</span></label>
                              <input type="text" name="doctor_name" placeholder="eg. Indra" readonly="readonly" class="form-control" id="doctor_id" required="required">
                              <span class="help-block"></span>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Total Biaya Obat<span class="text-danger">*</span></label>
                              <input type="text" name="amount_material" readonly="readonly" class="form-control" id="total_material" required="required" value="0">
                              <span class="help-block"></span>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Tanggal Pemeriksaan<span class="text-danger">*</span></label>
                              <input type="text" name="check_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control" readonly="readonly" id="check_date" required="required">
                              <span class="help-block"></span>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                        <!-- <small class="text-muted">Daftar Unit Kompetensi</small> -->
                      </div>
                      <div class="col-md-6 text-right">
                        <button class="btn btn-success btn-bordered waves-effect waves-light" data-toggle="tooltip" data-original-title="Tambah Baris" onclick="onAddRow()" type="button"><i class="mdi mdi-plus"></i></button>
                      </div>
                    </div>

                  <div class="row mt-20">
                    <div class="col-md-12">
                      <table class="table table-bordered" id="details-outpatient-table">
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
                            <td colspan="8" class="text-center">Tidak ada data</td>
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
                    <div class="col-md-12">
                      <table class="table table-bordered" id="details-outpatient-material">
                        <thead>
                          <tr>
                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Bahan/Obat</th>
                            <th class="text-center" colspan="3">Biaya Bahan/Obat</th>
                            <th  rowspan="2" style="width: 50px"></th>


                          </tr>
                          <tr>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Banyak</th>
                            <th class="text-center">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr id="empty-row1">
                            <td colspan="7" class="text-center">Tidak ada data</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <input type="text" name="last_index" value="0" hidden="hidden">

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
<script src="{{ url('assets/js/pages/outpatient-add.js') }}"></script>
@endpush
@extends('layouts.master')

@section('title')
  Ubah Pemeriksaan Rawat Jalan
@endsection

@section('content')

@php($active = 'examination_outpatient')


<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="page-title-box">
          <h4 class="page-title"> Ubah Pemeriksaan Rawat Jalan </h4>
          <ol class="breadcrumb p-0 m-0">
              <li>
                  <a href="{{ url('examination_outpatient') }}">Pemeriksaan Rawat Jalan</a>
              </li>
              <li class="active">
                  Ubah Pemeriksaan Rawat Jalan
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
     <form id="form-add-examination_outpatient" method="post" action="{{ route('examination_outpatient.update', $examination_outpatient->id) }}">
        @csrf
        @method('PUT')

        <div class="card-box">
          <div class="modal-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="field-1" class="control-label">No Registrasi <span class="text-danger">*</span></label>
                              <input type="text" name="outpatient_id" value="{{ $examination_outpatient->outpatient->no_registrasi}}" readonly="readonly" class="form-control" id="outpatient_id" required="required">
                              
                              <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                              <label class="control-label">Nama<span class="text-danger">*</span></label>
                              <input type="text" name="pasien_id" value="{{ $examination_outpatient->pasien_id }}" readonly="readonly" class="form-control" id="pasien_id" required="required">
                              <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                              <label class="control-label">Total Biaya Tindakan<span class="text-danger">*</span></label>
                              <input type="text" name="amount_lab" hidden="hidden" value="{{$examination_outpatient->amount_lab}}">
                              <input type="text" name="amount_action" value="{{ $examination_outpatient->amount_action }}" readonly="readonly" class="form-control" id="total_action" required="required" value="0">
                              <span class="help-block"></span>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Total Pembayaran<span class="text-danger">*</span></label>
                              <input type="text" name="amount" value="{{ $examination_outpatient->amount }}" id="total_pembayaran" readonly="readonly" class="form-control" required="required" value="0">
                              <span class="help-block"></span>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label class="control-label">Tanggal Periksa<span class="text-danger">*</span></label>
                              <input type="text" name="registration_date" value="{{ $examination_outpatient->registration_date }}" class="form-control" readonly="readonly" id="check_date" required="required">
                              <span class="help-block"></span>
                          </div>

                          <div class="form-group">
                              <label class="control-label">Dokter<span class="text-danger">*</span></label>
                              <input type="text" name="doctor_name" value="{{ $examination_outpatient->doctor_name }}" readonly="readonly" class="form-control" id="doctor_id" required="required">
                              <span class="help-block"></span>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Total Biaya Obat<span class="text-danger">*</span></label>
                              <input type="text" name="amount_material" value="{{ $examination_outpatient->amount_material }}" readonly="readonly" class="form-control" id="total_material" required="required" value="0">
                              <span class="help-block"></span>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Tanggal Pemeriksaan<span class="text-danger">*</span></label>
                              <input type="text" name="check_date" value="{{ $examination_outpatient->check_date }}" class="form-control" readonly="readonly" id="check_date" required="required" readonly="readonly">
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
                          @if(empty($examination_outpatient->details))
                          <tr id="empty-row">
                            <td colspan="6" class="text-center">Tidak ada data</td>
                          </tr>
                          @else

                          @php($row_length = 1)

                          @foreach ($examination_outpatient->details as $data_details)
                            <tr id="{{ $row_length }}"> 
                              <td style="width: 35%">
                                <div class="form-group clearfix"> 
                                  <select name="action_id[{{ $row_length }}]" class="select2 form-control action-id" required="required" data-placeholder="Pilih Tindakan">
                                    @foreach ($actions as $action)
                                    <option value="{{ $action['id'] }}" {{ $action['id'] == $data_details->action->action ? 'selected=selected' : '' }}>{{ $action['text'] }}</option>
                                    @endforeach
                                  </select>
                                  <span class="help-block"></span> 
                                </div> 
                              </td> 
                              <td>
                                <div class="form-group"> 
                                  <div class="input-group"> 
                                    <input name="cost_outpatient[{{ $row_length }}]" type="text" class="form-control text-center" required="required" placeholder="0" onkeyup="onCalculate(this.value, document.getElementsByName('many_action[{{ $row_length }}]')[0].value,{{ $row_length }})" value="{{ $data_details->cost_outpatient }}">
                                  </div> 
                                  <span class="help-block"></span> 
                                </div> 
                              </td>

                            <td>
                              <div class="form-group"> 
                                <div class="input-group"> 
                                  <input name="many_action[{{ $row_length }}]" type="text" class="form-control text-center" required="required" placeholder="0" onkeyup="onCalculate(this.value, document.getElementsByName('cost_outpatient[{{ $row_length }}]')[0].value,{{ $row_length }})" value="{{ $data_details->many_action }}">
                                </div> 
                                <span class="help-block"></span> 
                              </div> 
                            </td> 

                            <td>
                              <div class="form-group"> 
                                <div class="input-group"> 
                                  <input name="total_action[{{ $row_length }}]" id="total_action[{{ $row_length }}]" type="text" value="{{ $data_details->total_action }}" class="form-control text-center" readOnly="readOnly" required="required" placeholder="Jumlah JP">
                                </div> 
                                <span class="help-block"></span>
                              </div> 
                            </td>

                            <td style="width: 20%">
                                <div class="form-group clearfix"> 
                                  <select name="doctor_id[{{ $row_length }}]" class="select2 form-control competence-id" required="required" data-placeholder="Pilih Dokter">
                                    @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor['id'] }}" {{ $doctor['id'] == $data_details->competence_id ? 'selected=selected' : '' }}>{{ $doctor['text'] }}</option>
                                    @endforeach
                                  </select>
                                  <span class="help-block"></span> 
                                </div> 
                              </td> 

                            <td style="width:50px" class="text-center"><button type="button" class="btn btn-danger tn-bordered waves-effect waves-light removeRow"  data-toggle="tooltip" data-original-title="Hapus"><i class="mdi mdi-close"></i></button></td> 
                            </tr>
                            @php($row_length++)

                            @endforeach
                            
                          @endif
                        </tbody>
                      </table>
                    </div>
                    <input type="text" name="last_index" value="{{ $row_length - 1 }}" hidden="hidden">
                    <hr>

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
                          @if(empty($examination_outpatient->material))
                          <tr id="empty-row1">
                            <td colspan="6" class="text-center">Tidak ada data</td>
                          </tr>
                          @else

                          @php($row_length = 1)

                          @foreach ($examination_outpatient->material as $data_materials)
                            <tr id="{{ $row_length }}"> 
                              <td style="width: 35%">
                                <div class="form-group clearfix"> 
                                  <select name="material_id[{{ $row_length }}]" class="select2 form-control action-id" required="required" data-placeholder="Pilih Tindakan">
                                    @foreach ($materials as $material)
                                    <option value="{{ $material['id'] }}" {{ $material['id'] == $data_materials->material->name ? 'selected=selected' : '' }}>{{ $material['text'] }}</option>
                                    @endforeach
                                  </select>
                                  <span class="help-block"></span> 
                                </div> 
                              </td> 
                              <td>
                                <div class="form-group"> 
                                  <div class="input-group"> 
                                    <input name="price_material[{{ $row_length }}]" type="text" class="form-control text-center" required="required" placeholder="0" onkeyup="onCalculate1(this.value, document.getElementsByName('many_material[{{ $row_length }}]')[0].value,{{ $row_length }})" value="{{ $data_materials->price_material }}">
                                  </div> 
                                  <span class="help-block"></span> 
                                </div> 
                              </td>

                            <td>
                              <div class="form-group"> 
                                <div class="input-group"> 
                                  <input name="many_material[{{ $row_length }}]" type="text" class="form-control text-center" required="required" placeholder="0" onkeyup="onCalculate1(this.value, document.getElementsByName('price_material[{{ $row_length }}]')[0].value,{{ $row_length }})" value="{{ $data_materials->many_material }}">
                                </div> 
                                <span class="help-block"></span> 
                              </div> 
                            </td> 

                            <td>
                              <div class="form-group"> 
                                <div class="input-group"> 
                                  <input name="total_material[{{ $row_length }}]" id="total_material[{{ $row_length }}]" type="text" value="{{ $data_materials->total_material }}" class="form-control text-center" readOnly="readOnly" required="required" placeholder="Jumlah JP">
                                </div> 
                                <span class="help-block"></span>
                              </div> 
                            </td>


                            <td style="width:50px" class="text-center"><button type="button" class="btn btn-danger tn-bordered waves-effect waves-light removeRow"  data-toggle="tooltip" data-original-title="Hapus"><i class="mdi mdi-close"></i></button></td> 
                            </tr>
                            @php($row_length++)

                            @endforeach
                            
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <input type="text" name="last_index_2" value="0" hidden="hidden">

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
                      <table class="table table-bordered" id="details-outpatient-lab">
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
                          @if(empty($examination_outpatient->labs))
                            <tr id="empty-row-lab">
                              <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                          @else

                          @php($row_length = 1)

                          @foreach ($examination_outpatient->labs as $lab)
                            <tr>
                              <td style="width: 35%">
                                <div class="form-group clearfix">
                                  <input type="text" name="check_lab_id[{{$row_length}}]" value="{{ $lab->id }}" hidden="hidden">
                                  <select name="lab_id[{{$row_length}}]" class="select2 form-control lab-id" required="required" data-placeholder="Pilih Lab">
                                    <!--  -->
                                    @foreach ($labs as $detilLab)
                                      <option value="{{ $detilLab['id'] }}" {{ $detilLab['id'] == $lab->lab_id ? 'selected=selected' : '' }}>{{ $detilLab['keterangan'] }}</option>
                                    @endforeach
                                  </select>
                                  <span class="help-block"></span>
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <div class="input-group">
                                    <input name="hasil_lab[{{$row_length}}]" type="text" class="form-control text-center" required="required" placeholder="Positif DBD" value="{{$lab->hasil}}">
                                  </div>
                                  <span class="help-block"></span>
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <div class="input-group">
                                    <input name="price_lab[{{$row_length}}]" type="text" class="form-control text-center" required="required" placeholder="150000" onkeyup="onCalculateAllLab()" value="{{$lab->biaya}}">
                                  </div>
                                  <span class="help-block"></span>
                                </div>
                              </td>
                              <td style="width: 20%">
                                <div class="form-group clearfix">
                                  <select data-id="{{$row_length}}" name="doctor_id_lab[{{$row_length}}]" class="select2 form-control doctor-lab-id" required="required" data-placeholder="Pilih Dokter">
                                    <!--  -->
                                    @foreach ($doctors as $doctor)
                                      <option value="{{ $doctor['id'] }}" {{ $doctor['id'] == $lab->doctor_id ? 'selected=selected' : '' }}>{{ $doctor['text'] }}</option>
                                    @endforeach
                                  </select>
                                  <span class="help-block"></span>
                                </div>
                              </td>
                              <td style="width:50px" class="text-center"><button type="button" class="btn btn-danger tn-bordered waves-effect waves-light removeRow" data-toggle="tooltip" data-original-title="Hapus"><i class="mdi mdi-close"></i></button></td>
                            </tr>
                          @php($row_length++)
                          @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <input type="text" name="last_index_3" value="{{ $row_length - 1 }}" hidden="hidden">

                  <hr>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>
                      <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan Perubahan</button>
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

@extends('layouts.master')

@section('title')
	Tambah Tindakan
@endsection

@section('content')

@php($active = 'action')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Tindakan</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('action.index') }}">Tindakan</a>
                    </li>
                    <li class="active">
                        Tambah Tindakan
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
                    <form method="post" action="{{ route('action.store') }}" id="form-add-edit">
                        @csrf
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tindakan<span class="text-danger">*</span></label>
                                <input type="text" name="action" class="form-control" placeholder="eg: Suntik" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Kelas<span class="text-danger">*</span></label>
                                <select name="level_id" class="select2" data-placeholder="Pilih Kelas" data-allow-clear="true" required="required">
                                    <option></option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->code }} - {{ $level->class }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">    
                            <div class="form-group">
                                <label class="control-label">Bahan & Alat</label>
                                <input type="text" name="material" id="material"  class="form-control number" placeholder="eg: 100" required="required" value="0" onchange="sum()">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Jasa RS</label>
                                <input type="text" name="service_rs" id="service_rs"  class="form-control number" placeholder="eg: 100" required="required" value="0" onchange="sum()">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-3">    
                            
                            <div class="form-group">
                                <label class="control-label">Jasa Medis</label>
                                <input type="text" name="service_medis" id="service_medis"  class="form-control number" placeholder="eg: 100" required="required" value="0" onchange="sum()" >
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Jasa Anestesi</label>
                                <input type="text" name="service_anestesi" id="service_anestesi" class="form-control number" placeholder="eg: 100" value="0" required="required"onchange="sum()" >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            

                            <div class="form-group">
                                <label class="control-label">Jasa Lain-Lain</label>
                                <input type="text" name="service_dll" id="service_dll"  class="form-control number" placeholder="eg: 100" value="0" required="required" onchange="sum()">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Total</label>
                                <input type="text" name="total" id="total" class="form-control number" placeholder="eg: 100" value="0" required="required" readonly="readonly">
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
<script src="{{ url('assets/js/pages/action-add-edit.js') }}"></script>
<script type="text/javascript">
  jQuery(function($) {
      $('.autonumber').autoNumeric('init');
  });
</script>
@endpush


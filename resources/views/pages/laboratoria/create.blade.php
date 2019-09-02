@extends('layouts.master')

@section('title')
	Tambah Laboratorium
@endsection

@section('content')

@php($active = 'laboratoria')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Laboratorium</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('laboratoria.index') }}">Laboratorium</a>
                    </li>
                    <li class="active">
                        Tambah Laboratorium
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
                    <form method="post" action="{{ route('laboratoria.store') }}" id="form-add-edit">
                        @csrf
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Laboratorium<span class="text-danger">*</span></label>
                                <input type="text" name="keterangan" class="form-control" placeholder="eg: Rontgent" required="required">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Harga<span class="text-danger">*</span></label>
                                <input type="text" name="harga" class="form-control" placeholder="eg: 100.000" required="required">
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
<script src="{{ url('assets/js/pages/laboratoria-add-edit.js') }}"></script>
<script type="text/javascript">
  jQuery(function($) {
      $('.autonumber').autoNumeric('init');
  });
</script>
@endpush


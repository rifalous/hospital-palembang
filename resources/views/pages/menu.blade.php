@extends('layouts.master')

@section('title')
	Menu
@endsection

@section('content')
	
@php($active = 'menu')

	<div class="container" id="menu-menu">

        <div class="row">
			<div class="col-xs-12">
				<div class="page-title-box">
                    <h4 class="page-title">Menu</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="active">
                            Menu
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
			</div>
		</div>
        <!-- end row -->


        <div class="row">
        	<div class="col-md-4">
				<div class="card-box clearfix">
					<form id="form-add">
						<h4 class="m-t-0 header-title">Add new</h4>
						<hr>
						<input type="text" name="id" hidden="hidden">
						<input type="text" name="order_number" hidden="hidden">
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Name *" required="required">
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<input type="text" name="url" class="form-control" placeholder="URL">
						</div>
						<div class="form-group">
							<select name="method" class="select2" data-placeholder="Select method">
								<option></option>
								@foreach ($permissions as $permission)
									<option value="{{ $permission->name }}">{{ $permission->name }}</option>
								@endforeach
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<input type="text" name="icon" class="form-control" placeholder="Icon">
						</div>
						<div class="form-group">
							<select name="is_showed" class="select2" data-placeholder="Active *" required="required">
								<option></option>
								<option value="0">No</option>
								<option value="1">Yes</option>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<hr>
							<div class="pull-right">
								<button class="btn btn-primary btn-bordered waves-effect waves-light" id="btn-add" type="button">Add to menu</button>
								<button type="button" class="btn btn-default btn-bordered waves-effect waves-light" style="display: none" id="btn-cancel">Batal</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			
			<div class="col-md-8">
				<div class="card-box clearfix" id="menu">
					
				</div>
            </div>
		</div>

	</div>
    <!-- end row -->

<!-- Modal for question -->
<div class="modal fade in" tabindex="-1" role="dialog" id="modal-delete-confirm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Apakah anda yakin?</h4>
            </div>
            <div class="modal-body">Data yang dipilih akan dihapus, apakah anda yakin?</div>
            <div class="modal-footer">
                <button type="submit" id="btn-confirm" class="btn btn-danger btn-bordered waves-effect waves-light" data-dismiss="modal">Hapus</button>
                <button type="button" class="btn btn-default btn-bordered waves-effect waves-light" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
	<script src="{{ url('assets/js/pages/menu.js') }}"></script>
@endpush
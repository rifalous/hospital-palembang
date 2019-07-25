var tblMenu;

$(document).ready(function(){

	tblMenu =  $('#table-menu').DataTable({
        processing: true,
        serverSide: true,
        order: [1, 'asc'],
        ajax: SITE_URL + '/setting/menu/get_data',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'option', name: 'option', orderable: false, searchable: false, class: 'text-center' },
            { data: 'order_number', name: 'order_number', class: 'text-center' },
            { data: 'menu_name', name: 'menu_nen' },
            { data: 'parent_name', name: 'parent_en' },
            { data: 'class', name: 'class', class: 'text-center' },
            { data: 'url', name: 'url' },
            { data: 'user_group', name: 'user_group' }

        ],
		drawCallback: function(){
			$('#check-all, input[name="check_row[]"]').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });
			
			//$('.input-sm').select2();
			
			$('#check-all').on('ifChecked', function(event){
				$('input[name="check_row[]"]').iCheck('check');
			});
			
			$('#check-all').on('ifUnchecked', function (event) {
				$('input[name="check_row[]"]').iCheck('uncheck');
			});
		}/* ,
		scrollCollapse: true,
		scrollX: '500px', */
	});

});

$("#searchtext").keyup(function(event){
    if(event.keyCode == 13){
       on_search();
    }
});

// if modal closed

$('#modal-add-edit').on('hidden.bs.modal', function () {
  on_refresh();
});

// refresh

function on_refresh() {
	$('#form-add-edit').trigger('reset').validate().resetForm();
	$('#form-add-edit select').val(null).trigger('change');
	$('.form-group').removeClass('has-error');
	$('.help-block').html('');
}

// on search

function on_search() {
	var src = $('#searchtext').val();
	tblMenu.search(src).draw();
}

// clear

function on_clear() {
    $('#searchtext').val('');
    tblMenu.search('').draw();
}

// add

function on_add()
{
	$('#title').html(MENU_ADD);
	$('#btn-save').html(BTN_SAVE);
	$('#modal-add-edit').modal('show');
}

// save and edit

function on_save() {

	var data = $('#form-add-edit').serializeArray();
    var form = $('#form-add-edit').validate();

    if ( $('[name="id"]').val() == "" ) {

    	url = SITE_URL + '/setting/menu';
    	method = 'POST';

    } else {

    	url = SITE_URL + '/setting/menu/'+ $('[name="id"]').val();
    	method = 'PUT';

    }

    if (form.form() == true) {
        $.ajax({
            url: url,
            type: method,
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'JSON',
            beforeSend: function(){
				$('#btn-save').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>' + BTN_LOADING);
            },
            success: function(data){
				show_notification(data.title, data.type, data.message);
				if (data.type == 'success') {
					$('#modal-add-edit').modal('hide');
				}
				on_clear();
            },
			error: function(error, sts, xhr){
				show_notification(LBL_ERROR, 'error', xhr);
			},
			complete:function () { 
				$('#btn-save').html(BTN_SAVE);
			}
        });
    }
}

// modal edit appear

function on_edit() {
	if ($('input[name="check_row[]"]:checked').length == 0) {

		show_notification(LBL_INFORMATION, 'warning', LBL_REQUIRE_SELECT);
  	
  	}

	  else if ($('input[name="check_row[]"]:checked').length > 1) {
		show_notification(LBL_INFORMATION, 'warning', LBL_ONLY_ONE_SELECT);
  	
  	}

	  else {

		var id = $('input[name="check_row[]"]:checked').val();
		var data = get_data(id);
		edit_form(data);
  	}
}

// get data by id

function get_data(id) {

	var res = $.ajax({

		async: false,
		url: SITE_URL + '/setting/menu/' + id + '/edit',
		type: 'GET',
		dataType: 'JSON'

	});

	return res.responseJSON;
}

// map data into form

function edit_form(data) {
	$('#btn-save').html(BTN_UPDATE);
	$('#title').html(MENU_EDIT);

	user_group = data.user_group.split(';');

	$('[name="id"]').val(data.id);
	$('[name="menu_en"]').val(data.menu_en);
	$('[name="menu_id"]').val(data.menu_id);
	$('[name="parentid"]').val(data.parentid).trigger('change');
	$('[name="class"]').val(data.class);
	$('[name="url"]').val(data.url);
	$('[name="user_group[]"]').val(user_group).trigger('change');
	$('[name="order_number"]').val(data.order_number);

	$('#modal-add-edit').modal('show');

}

// delete

function on_delete() {
	if ($('input[name="check_row[]"]:checked').length == 0) {

	    show_notification(LBL_INFORMATION, 'warning', LBL_REQUIRE_SELECT);

  	} else {

	    $('#modal-delete-confirm').modal('show');

  	}
}

function on_destroy() {

	var id = [];

	$('input[name="check_row[]"]:checked').each(function(){
		id.push($(this).val());
	});

	$.ajax({

		url: SITE_URL + '/setting/menu/destroy',
		type: 'DELETE',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data: {
		    id: id,
		},
		dataType: 'JSON',

		beforeSend: function(){
		    $('#btn-confirm').attr('disabled', 'disabled');
		    $('#btn-confirm').html('<i class="fa fa-spinner fa-pulse"></i> ' + BTN_LOADING);
		},
		success: function(data){
		    show_notification(data.title, data.type, data.message);

		    on_clear();
		    $('#modal-delete-confirm').modal('hide');
		    $('#btn-confirm').removeAttr('disabled');
		    $('#btn-confirm').text(BTN_YES);


		},
		error: function(xhr, status, error) {
		    show_notification(LBL_ERROR, 'error', error);

		    on_clear();
		    $('#modal-delete-confirm').modal('hide');
		    $('#btn-confirm').removeAttr('disabled');
		    $('#btn-confirm').text(BTN_YES);

		}

	});

}
var tbProgram;
$(document).ready(function(){
	tbProgram = $('#table-registration_outpatient').DataTable({
		// order: [2, 'asc'],
		ajax: SITE_URL + '/registration_outpatient/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		columns: [
				//{ data: 'option', name: 'option', orderable: false,  class: 'text-center' },
				{ data: 'no_registrasi', name: 'no_registrasi' },
				{ data: 'pasien_name', name: 'pasien_name' },
				{ data: 'pasien_gender', name: 'pasien_gender' },
				{ data: 'pasien_age', name: 'pasien_age' },
				{ data: 'address', name: 'address'},
				{ data: 'doctor_name', name: 'doctor_name'},
				{ data: 'tgl_periksa', name: 'tgl_periksa'},
				{ data: 'poliklinik', name: 'poliklinik'},
				{ data: 'disease', name: 'disease'},
				{ data: 'complaint', name: 'complaint'},
				{ data: 'actions', name: 'actions', searching: false, sorting: false, class: 'text-center' }
		],
		searchable: false,
		scrollCollapse: true,
		scrollX: '100%',
		drawCallback: function(){
			$('[data-toggle="tooltip"]').tooltip({
				'container': 'body'
		});
		}
	});
	$('#search').keyup(function(event){
		    if(event.keyCode == 13){
		       on_search();
		    }
	});

	$('#modal-add-edit').on('hidden.bs.modal', function () {
		on_clear();
	});

	$('#select-all').click(function(even){
		if(this.checked) {
			// Iterate each checkbox
			$('[name="rowcheck[]"]').each(function() {
				this.checked = true;                        
			});
		} else {
			$('[name="rowcheck[]"]').each(function() {
				this.checked = false;                        
			});
		}
	});

	$('#btn-confirm').click(function(){
		var id = [];
		$('input[name="rowcheck[]"]:checked').each(function(){
			id.push($(this).val());
		});

		request('destroy/', id);
	});

	$('#btn-confirm-by-id').click(function(){
		const pasien_id = $(this).data('value');
		request('remove/'+pasien_id, pasien_id);
	});

});

function request(url, data) {
	$.ajax({

		url: SITE_URL + '/registration_outpatient/'+url,
		type: 'DELETE',
		data: {
			id: data
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		beforeSend: function(){
			$('#btn-confirm').attr('disabled', 'disabled');
			$('#btn-confirm').html('<i class="fa fa-spinner fa-pulse"></i> Loading ...');
			$('#btn-confirm-by-id').attr('disabled', 'disabled');
			$('#btn-confirm-by-id').html('<i class="fa fa-spinner fa-pulse"></i> Loading ...');
		},
		success: function(data){
			show_notification(data.title, data.type, data.message);
			$('#modal-delete-confirm').modal('hide');
			on_search();
		},
		error: function(xhr, status, error) {
			show_notification('Error', 'error', error);
		},
		complete:function () { 
			$('#btn-confirm').html('Ya');
			$('#btn-confirm').removeAttr('disabled');
			$('#btn-confirm-by-id').html('Ya');
			$('#btn-confirm-by-id').removeAttr('disabled');
		}
	});
}

// search

function on_search()
{
	var src = $('#search').val();
  	tbProgram.search(src).draw();
}

// clear search

function on_clear_search()
{
	$('#search').val('');
	on_search();
}

// clear

function on_clear()
{
	$('#search').val('');
	$('#form-add-edit').trigger('reset').validate().resetForm();
  	$('.form-group').removeClass('has-error');
  	$('.help-block').html('');

}

// edit

function on_edit()
{
	if ($('input[name="rowcheck[]"]:checked').length == 0) {
      	show_notification('Informasi', 'warning', 'Silahkan Pilih Data Dahulu!');
  	}
  	else if ($('input[name="rowcheck[]"]:checked').length > 1) {
      	show_notification('Information', 'warning', 'Silahkan Pilih Salah Satu Data!');
  	}
  	else {

		var id = $('input[name="rowcheck[]"]:checked').val();
		window.location.replace(SITE_URL + '/registration_outpatient/'+id+'/edit');
  	}
}

//show

function on_show()
{
	if ($('input[name="rowcheck[]"]:checked').length == 0) {
      	show_notification('Informasi', 'warning', 'Silahkan Pilih Data Dahulu!');
  	}
  	else if ($('input[name="rowcheck[]"]:checked').length > 1) {
      	show_notification('Information', 'warning', 'Silahkan Pilih Salah Satu Data!');
  	}
  	else {

		var id = $('input[name="rowcheck[]"]:checked').val();
		window.location.replace(SITE_URL + '/registration_outpatient/'+id);
  	}
}

// delete

function on_delete(pasien_id)
{
	if (pasien_id != undefined) {
		$('#btn-confirm').hide();
		$('#btn-confirm-by-id').show();
		$('#modal-delete-confirm').modal('show');
    $('#btn-confirm-by-id').data('value', pasien_id);
	} else {
		if ($('input[name="rowcheck[]"]:checked').length == 0) {
				show_notification('Informasi', 'warning', 'Silahkan Pilih Data Dahulu!');
		} else {
				$('#modal-delete-confirm').modal('show');
		}
	}

}

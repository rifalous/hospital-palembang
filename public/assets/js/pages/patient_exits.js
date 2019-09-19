var tbProgram;
$(document).ready(function(){
	tbProgram = $('#table-patient-exits').DataTable({
        // order: [2, 'asc'],
        ajax: SITE_URL + '/patient_exits/get_data',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'option', name: 'option', orderable: false, searchable: false, class: 'text-center' },
            { data: 'no_registrasi', name: 'no_registrasi' },
            { data: 'pasien_name', name: 'pasien_name' },
            { data: 'pasien_age', name: 'pasien_age' },
            { data: 'pasien_gender', name: 'pasien_gender'},
            { data: 'tgl_masuk', name: 'tgl_masuk'},
            { data: 'time', name: 'time'},
            { data: 'room_name', name: 'room_name'},
            { data: 'room_class', name: 'room_class'},
            { data: 'disease', name: 'disease'},
            { data: 'tgl_keluar', name: 'tgl_keluar'},
            { data: 'time_keluar', name: 'time_keluar'},
            { data: 'way_out', name: 'way_out'},
            { data: 'exit_state', name: 'exit_state'},
            { data: 'total_biaya', name: 'total_biaya'}
        ],
        	scrollCollapse: true,
					scrollX: '100%',
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

		$.ajax({

			url: SITE_URL + '/patient_exits/destroy/',
			type: 'DELETE',
			data: {
				id: id
			},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			beforeSend: function(){
				$('#btn-confirm').attr('disabled', 'disabled');
				$('#btn-confirm').html('<i class="fa fa-spinner fa-pulse"></i> Loading ...');
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
				$('#btn-confirm').html('Yes');
				$('#btn-confirm').removeAttr('disabled');
			}
		});

	});

});

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
		window.location.replace(SITE_URL + '/patient_exits/'+id+'/edit');
  	}

}

// delete

function on_delete()
{

	if ($('input[name="rowcheck[]"]:checked').length == 0) {
	    show_notification('Informasi', 'warning', 'Silahkan Pilih Data Dahulu!');
	} else {
	    $('#modal-delete-confirm').modal('show');
	}

}

$.fn.dataTable.ext.errMode = 'throw';
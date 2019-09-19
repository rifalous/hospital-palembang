var tbPayment;

$(document).ready(function(){
	tbPayment = $('#table-payment').DataTable({
        // order: [2, 'asc'],
        ajax: SITE_URL + '/payment/get_data',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'option', name: 'option' , orderable: false, searchable: false, class: 'text-center' },
            { data: 'outpatient.no_registrasi', name: 'outpatient.no_registrasi' },
            { data: 'pasien_id', name: 'pasien_id' },
            { data: 'tgl_bayar', name: 'tgl_bayar' },
            { data: 'total_biaya', name: 'total_biaya'},
            { data: 'sisa_tagihan', name: 'sisa_tagihan'},
            { data: 'sisa_pembayaran', name: 'sisa_pembayaran'},
            { data: 'payment', name: 'payment'},
        ],
        	searching: false,

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

			url: SITE_URL + '/payment/destroy/',
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
	tbPayment.search(src).draw();
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
		window.location.replace(SITE_URL + '/payment/'+id+'/edit');
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

function getOutpatientDetail(id) {
	var res = $.ajax({
		url: SITE_URL+'/payment/get-outpatient-id/'+id,
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}

function getOutpatient()
{
	var res = $.ajax({
		url: SITE_URL + '/payment/get_outpatient',
		type: 'get',
		dataType: 'json',
		async: false,
	});

	return res.responseJSON;
}

arr_outpatient = getOutpatient();

$('.outpatient-id').select2({
    data: arr_outpatient
}).on('change', function(){
	var outpatient = getOutpatientDetail($(this).val());
	$('[name="total_biaya"]').val(examination_outpatient.amount);
	// $('[name="pasien_id"]').val(examination_outpatient.pasien.name);
	// $('[name="doctor_id"]').val(examination_outpatient.doctor.name);
});


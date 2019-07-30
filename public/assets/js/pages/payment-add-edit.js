$(document).ready(function(){
	$('#form-add-edit').validate();
});

function getOutpatientDetail(outpatient_id) {
	var res = $.ajax({
		url: SITE_URL+'/payment/get-outpatient-id/'+outpatient_id,
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}

<<<<<<< Updated upstream
<<<<<<< Updated upstream
=======
=======
>>>>>>> Stashed changes
function getPasienData(pasien_id) {
	var res = $.ajax({
		url: SITE_URL+'/pasien/details-data/'+pasien_id,
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}

<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
<<<<<<< Updated upstream
=======


>>>>>>> Stashed changes
=======


>>>>>>> Stashed changes
arr_outpatient = getOutpatient();

$('.outpatient-id').select2({
    data: arr_outpatient
}).on('change', function(){
	var examination_outpatient = getOutpatientDetail($(this).val());
<<<<<<< Updated upstream
<<<<<<< Updated upstream
	$('[name="total_biaya"]').val(examination_outpatient.amount);
	$('[name="pasien_id"]').val(examination_outpatient.pasien_id);
=======
=======
>>>>>>> Stashed changes
	var pasien_data = getPasienData($(this).val());
	$('[name="total_biaya"]').val(examination_outpatient.amount);
	$('[name="pasien_id"]').val(examination_outpatient.pasien_id);
	$('[name="address"]').val(pasien_data.address);
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
	// $('[name="doctor_id"]').val(examination_outpatient.doctor.name);
});
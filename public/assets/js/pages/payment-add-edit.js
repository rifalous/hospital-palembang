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

// function getPasienData(pasien_id) {
// 	var res = $.ajax({
// 		url: SITE_URL+'/pasien/details-data/'+pasien_id,
// 		type: 'get',
// 		dataType: 'json',
// 		async: false
// 	});

// 	return res.responseJSON;
// }

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
	var examination_outpatient = getOutpatientDetail($(this).val());
	//var pasien_data = getPasienData($(this).val());
	$('[name="total_biaya"]').val(examination_outpatient.amount);
	$('[name="pasien_id"]').val(examination_outpatient.pasien_id);
	//$('[name="address"]').val(pasien_data.address);
	// $('[name="doctor_id"]').val(examination_outpatient.doctor.name);
});
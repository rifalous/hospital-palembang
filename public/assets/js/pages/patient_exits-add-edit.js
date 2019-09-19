var arr_Inpatient;
$(document).ready(function(){
	$('#form-add-edit').validate();
	arr_Inpatient = getInpatient();
	$('[name="no_registrasi"]').select2({
		data: arr_Inpatient
	}).on('change', function(){
		var inpatient = getInpatientDetail($(this).val());
		$('[name="pasien_id"]').val(inpatient.pasien.id).change();
		$('[name="tgl_masuk"]').val(inpatient.tgl_masuk).change();
		$('[name="time"]').val(inpatient.time).change();
		$('[name="disease"]').val(inpatient.disease).change();
		$('[name="room_id"]').val(inpatient.room_id).change();
		$('[name="total_biaya"]').val(inpatient.examination_inpatient.amount);
	});
});

function getInpatientDetail(id) {
	var res = $.ajax({
		url: SITE_URL+'/patient_exits/get-inpatient-id/'+id,
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}

function getInpatient()
{
	var res = $.ajax({
		url: SITE_URL + '/patient_exits/get_inpatient',
		type: 'get',
		dataType: 'json',
		async: false,
	});

	return res.responseJSON;
}
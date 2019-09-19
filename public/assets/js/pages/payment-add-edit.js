$(document).ready(function(){
	$('#form-add-edit').validate();
});

function getOutpatientDetail(outpatient_id) {
	console.log(outpatient_id);
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
	console.log("test1");
	var res = $.ajax({
		url: SITE_URL + '/payment/get_outpatient',
		type: 'get',
		dataType: 'json',
		async: false,
	});

	return res.responseJSON;
}

arr_outpatient = getOutpatient();
console.log(arr_outpatient);
$('.outpatient-id').select2({
    data: arr_outpatient
}).on('change', function(){
	console.log("test3");
	var examination_outpatient = getOutpatientDetail($(this).val());
	//var pasien_data = getPasienData($(this).val());
	$('[name="total_biaya"]').val(examination_outpatient.total_biaya).change();
	$('[name="pasien_id"]').val(examination_outpatient.pasien_id).change()
	$('[name="address"]').val(examination_outpatient.outpatient.address).change();
	$('[name="ket"]').val(examination_outpatient.ket).change();
	$('[name="sisa_pembayaran"]').val(examination_outpatient.sisa_pembayaran).change();
	$('[name="sisa_tagihan"]').val(examination_outpatient.sisa_tagihan).change();
	$('[name="diskon"]').val(examination_outpatient.diskon).change();
	$('[name="discount"]').val(examination_outpatient.discount).change();
	$('[name="payment"]').val(examination_outpatient.payment).change();
	$('[name="jumlah_dibayar"]').val(examination_outpatient.jumlah_dibayar).change();
});
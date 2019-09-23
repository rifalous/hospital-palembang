$(document).ready(function(){
    $('[name="lab_test[]"]').on("select2:select", function(e) {
		var temp = parseInt($('[name="total_amount"]').val());
		var action = getDetail($(this).val());
		temp = temp + parseInt(action.harga);
		$('[name="total_amount"]').val(temp);
	});

	$('[name="lab_test[]"]').on("select2:unselect", function(e) {
		var data = getDetail(e.params.data.id);
		var temp = parseInt($('[name="total_amount"]').val());
		temp = temp - parseInt(data.harga);
		$('[name="total_amount"]').val(temp);
    });
});

function getDetail(id) {
	var res = $.ajax({
		url: SITE_URL+'/lab_checkup/get-labo-id/'+id,
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}
$(document).ready(function(){
	$('#form-add-edit').validate();
	$('[name="no_registrasi"]').change(function(){
		$.ajax({
			url: SITE_URL + '/patient_exits/get_data/'+$(this).val(),
			type: 'get',
			dataType: 'json',
			success: function(data) {
				$('[name="pasien_id"]').val(""+data.pasien_id).change();
				$('[name="tgl_masuk"]').val(data.tgl_masuk);
				$('[name="time"]').val(data.time);
				$('[name="room_id"]').val(data.room_id).change();
				$('[name="disease"]').val(data.disease).change();
				$('[name="total_biaya"]').val(data.totalAmount).change();
			}
		});
	});
});
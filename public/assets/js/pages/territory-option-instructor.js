function getDistrict(value) {
	var res = $.ajax({

		url: SITE_URL + '/pasien/get_district/'+value,
		dataType: 'json',
		type: 'get',
		async: false
	
	});

	$('[name="city_id"]').find('option').remove();
	$('[name="district_id"]').find('option').remove();

	$('[name="city_id"]').select2({
		data: res.responseJSON
	});
}

function getCity(value) {
	var res = $.ajax({

		url: SITE_URL + '/pasien/get_city/'+value,
		dataType: 'json',
		type: 'get',
		async: false
	
	});

	$('[name="district_id"]').find('option').remove();

	$('[name="district_id"]').select2({
		data: res.responseJSON
	});
}


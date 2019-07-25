$(document).ready(function(){
	$('#form-add-edit').validate();

	

});

function sum() {

	var material 	     = parseInt(document.getElementById('material').value);
	var service_rs 	     = parseInt(document.getElementById('service_rs').value);
	var service_medis 	 = parseInt(document.getElementById('service_medis').value);
	var service_anestesi = parseInt(document.getElementById('service_anestesi').value);
	var service_dll 	 = parseInt(document.getElementById('service_dll').value);

	var total_action  = material + service_rs + service_medis + service_anestesi + service_dll;

	document.getElementById('total').value = total_action;

	console.log('total');
}
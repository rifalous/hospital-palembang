("#total_action1").change(function(){
	var hasil = 0;
	for (var i = 1; i<=i; i++) {
		var total_biaya_tindakan = document.getElementById('total_action['+i+']');
		if(total_biaya_tindakan){
			var total_biaya_tindakan_value = parseInt(total_biaya_tindakan.value);
		} else {
			var total_biaya_tindakan_value = 0;
		}
		hasil = parseInt(hasil + total_biaya_tindakan_value);
	}
	$(this).val(hasil);
});

function updatePrice(val)
{
	$("#total_action1").val(val);
	$("#total_action1").trigger('change');
}


$("#total_material1").change(function(){
	var hasil = 0;
	for (var i = 1; i<=i; i++) {
		var total_biaya_material = document.getElementById('total_material['+i+']');
		if(total_biaya_material){
			var total_biaya_material_value = parseInt(total_biaya_material.value);
		} else {
			var total_biaya_material_value = 0;
		}
		hasil = parseInt(hasil + total_biaya_material_value);
	}
	$(this).val(hasil);
});

function updatePrice1(val)
{
	$("#total_material1").val(val);
	$("#total_material1").trigger('change');
}

function updateTotalPrice(hasil)
{
	var total_tindakan = parseInt(document.getElementById('total_action1').value || 0);
	var total_material = parseInt(document.getElementById('total_material1').value || 0);
	var hasil = parseInt(total_tindakan + total_material);
	//console.log("Hasilnya : " + hasil);
	$("#total_pembayaran1").val(hasil);
	return;
}
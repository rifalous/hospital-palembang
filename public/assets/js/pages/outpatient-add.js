var row_length = parseInt($('[name="last_index"]').val());
var row_length2 = parseInt($('[name="last_index_2"]').val());
var row_length3 = parseInt($('[name="last_index_3"]').val());
var arr_action = [];
var arr_material = [];
var arr_doctor = [];
var arr_labo = [];
var arr_outpatient = [];

$(document).ready(function(){
	$('#details-outpatient-table').on('click', '.removeRow', function(){
	    var init_length = $('#details-outpatient-table > tbody > tr').length;

	    if (init_length <= 1) {
	        $('#details-outpatient-table > tbody').append('<tr class="text-center" id="empty-row"><td colspan="5">Tidak Ada Data</td></tr>');
	    }

		$(this).parent().parent().remove();
		updatePrice();
		updateTotalPrice();
	});

	$('#details-outpatient-material').on('click', '.removeRow', function(){
	    var init_length = $('#details-outpatient-material > tbody > tr').length;

	    if (init_length <= 1) {
	        $('#details-outpatient-material > tbody').append('<tr class="text-center" id="empty-row1"><td colspan="5">Tidak Ada Data</td></tr>');
	    }

		$(this).parent().parent().remove();
		updatePrice1();
		updateTotalPrice();
	});

	$('#details-outpatient-lab').on('click', '.removeRow', function(){
	    var init_length = $('#details-outpatient-lab > tbody > tr').length;

	    if (init_length <= 1) {
	        $('#details-outpatient-lab > tbody').append('<tr class="text-center" id="empty-row-lab"><td colspan="5">Tidak Ada Data</td></tr>');
		}

		$(this).parent().parent().remove();
		updatePrice2();
		updateTotalPrice();
	});

	

	$('#form-add-examination_outpatient').validate({
		rules: {
        code: {
            remote: {
                    url: SITE_URL + 'examination_outpatient/validate',
                    type: 'post',
                    data: {
                            code: function() { return $('input[name="code"]').val()},
                            id: function() { return $('input[name="id"]').val() != undefined ? $('input[name="id"]').val() : '' },
                            _token : function() { return $('meta[name="csrf-token"]').attr('content')}
                          }
                      }
                  },
      	},
    messages: {
        code: {
            remote: 'Code with {0} has been used'
        }
    },
    onkeyup: function(element){$(element).valid()},
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

});

function calculateAllOfData() {
	let total = 0;
	const amountMaterial = $('[name="amount_material"]').val();
	const amountAction = $('[name="amount_action"]').val();
	const amountLab = $('[name="amount_lab"]').val();
	if (amountMaterial != undefined || !isNaN(amountMaterial)) {
		total += parseInt(amountMaterial);
	}
	if (amountAction != undefined || !isNaN(amountAction)) {
		total += parseInt(amountAction);
	}
	if (amountLab != undefined || !isNaN(amountLab)) {
		total += parseInt(amountLab);
	}
	$('[name="amount"]').val(total);
}

function onCalculateAllAction() {
	let priceTotal = 0;
	$('[name^="total_action"]').each(function() {
		priceTotal += parseInt($(this).val());
	});
	$('[name="amount_action"]').val(priceTotal);
}

function onCalculateAllLab() {
	let priceTotal = 0;
	$('[name^="price_lab"]').each(function() {
		let value = isNaN($(this).val()) ? 0 : $(this).val();
		priceTotal += parseInt(value);
	});
	$('[name="amount_lab"]').val(priceTotal);
	calculateAllOfData();
}

function getAction()
{
	var res = $.ajax({
		url: SITE_URL + '/examination_outpatient/get_action',
		type: 'get',
		dataType: 'json',
		async: false,
	});

	return res.responseJSON;
}

function getMaterial()
{
	var res = $.ajax({
		url: SITE_URL + '/examination_outpatient/get_material',
		type: 'get',
		dataType: 'json',
		async: false,
	});

	return res.responseJSON;
}

function getDoctor()
{
	var res = $.ajax({
		url: SITE_URL + '/examination_outpatient/get_doctor',
		type: 'get',
		dataType: 'json',
		async: false,
	});

	return res.responseJSON;
}

function getLab()
{
	var res = $.ajax({
		url: SITE_URL + '/examination_inpatient/get_lab',
		type: 'get',
		dataType: 'json',
		async: false,
	});

	return res.responseJSON;
}

function onAddRow()
{

	
	$('[data-toggle="tooltip"]').tooltip('hide');

	$('#empty-row').remove();

    row_length = row_length + 1;

    var table = '<tr id="'+ row_length +'">' +
                     '<td style="width: 35%">'+
					 '<div class="form-group clearfix">' +
						'<select data-id="'+row_length+'" name="action_id['+ row_length +']" class="select2 form-control action-id" required="required" data-placeholder="Pilih Tindakan">'+
						'<option value=""></option></select>'+
						'<span class="help-block"></span>' +
                        '</div>' +
                    '</td>' +
                    '<td>'+
						'<div class="form-group">' +
	                		'<div class="input-group">' +
							  '<input readonly="readonly" name="cost_outpatient['+ row_length +']" readOnly="readOnly" type="text" class="form-control text-center"  required="required" placeholder="0" onkeyup="onCalculate(this.value, document.getElementsByName(\'many_action['+ row_length +']\')[0].value, '+row_length+')">'+
							'</div>' +
							'<span class="help-block"></span>' +
						'</div>' +
                    '</td>' +
                    '<td>'+
						'<div class="form-group">' +
	                		'<div class="input-group">' +
							  '<input name="many_action['+ row_length +']" type="text" class="form-control text-center"  required="required" placeholder="0"  onkeyup="onCalculate(this.value, document.getElementsByName(\'cost_outpatient['+ row_length +']\')[0].value, '+row_length+')">'+
							'</div>' +
							'<span class="help-block"></span>' +
						'</div>' +
                    '</td>' +
                    '<td>'+
						'<div class="form-group">' +
	                		'<div class="input-group">' +
							  '<input name="total_action['+ row_length +']" id="total_action['+ row_length +']" type="text" value="0" class="form-control text-center" readOnly="readOnly" required="required" placeholder="Jumlah Tindakan">'+
							'</div>' +
							'<span class="help-block"></span>' +
						'</div>' +
                    '</td>' +
                    '<td style="width: 20%">'+
						'<div class="form-group clearfix">' +
                        	'<select data-id="'+row_length+'" name="doctor_id['+ row_length +']" class="select2 form-control doctor-id" required="required" data-placeholder="Pilih Dokter"></select>'+
                        	'<span class="help-block"></span>' +
                        '</div>' +
                    '</td>' +
                    '<td style="width:50px" class="text-center"><button type="button" class="btn btn-danger tn-bordered waves-effect waves-light removeRow" data-toggle="tooltip" data-original-title="Hapus"><i class="mdi mdi-close"></i></button></td>' +
                '</tr>';
        
    $('#details-outpatient-table').append(table);

    arr_action = getAction();
    arr_doctor = getDoctor();

    $('.doctor-id').select2({
    	data: arr_doctor
    });

    $('.action-id').select2({
    	data: arr_action
    }).on('change', function(){
    	var rowid = $(this).data('id');
    	var action = getActionDetail($(this).val());
    	$('[name="cost_outpatient['+rowid+']"]').val(action.total);
    });


    $('.select2').select2();

    $('.number').keypress(function(e){
    	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	        return false;
	    }
    });

    $('#form-add-examination_outpatient').validate();

    $('[data-toggle="tooltip"]').tooltip({html: true});

    $('[name="cost_outpatient"]').change(function(){
    	console.log($(this).val());
    });

    $('[name="price_material"]').change(function(){
    	console.log($(this).val());
    });
}

function onAddRow1()
{
	$('[data-toggle="tooltip"]').tooltip('hide');

	$('#empty-row1').remove();

    row_length = row_length + 1;

    var table = '<tr id="'+ row_length +'">' +
                    '<td style="width: 35%">'+
                     	'<div class="form-group clearfix">' +
                        	'<select data-id="'+row_length+'" name="material_id['+ row_length +']" class="select2 form-control material-id" required="required" data-placeholder="Pilih Bahan/Obat"></select>'+
                        	'<span class="help-block"></span>' +
                        '</div>' +
                    '</td>' +
                    '<td>'+
						'<div class="form-group">' +
	                		'<div class="input-group">' +
							  '<input readonly="readonly" name="price_material['+ row_length +']"  type="text" class="form-control text-center" required="required" readOnly="readOnly" placeholder="0" onkeyup="onCalculate1(this.value, document.getElementsByName(\'many_material['+ row_length +']\')[0].value, '+row_length+')">'+
							'</div>' +
							'<span class="help-block"></span>' +
						'</div>' +
                    '</td>' +
                    '<td>'+
						'<div class="form-group">' +
	                		'<div class="input-group">' +
							  '<input name="many_material['+ row_length +']" type="text" class="form-control text-center" required="required" placeholder="0" onkeyup="onCalculate1(this.value, document.getElementsByName(\'price_material['+ row_length +']\')[0].value, '+row_length+')">'+
							'</div>' +
							'<span class="help-block"></span>' +
						'</div>' +
                    '</td>' +
                    '<td>'+
						'<div class="form-group">' +
	                		'<div class="input-group">' +
							  '<input name="total_material['+ row_length +']" id="total_material['+ row_length +']" type="text" value="0" class="form-control text-center" readOnly="readOnly" required="required" placeholder="Jumlah Tindakan">'+
							'</div>' +
							'<span class="help-block"></span>' +
						'</div>' +
                    '</td>' +
                    '<td style="width:50px" class="text-center"><button type="button" class="btn btn-danger tn-bordered waves-effect waves-light removeRow" data-toggle="tooltip" data-original-title="Hapus"><i class="mdi mdi-close"></i></button></td>' +
                '</tr>';
        
    $('#details-outpatient-material').append(table);

    // arr_action = getAction();
    arr_material = getMaterial();

    // $('.action-id').select2({
    // 	data: arr_action
    // })

    $('.material-id').select2({
    	data: arr_material
    }).on('change', function(){
    	var rowid = $(this).data('id');
    	var material = getMAterialDetail($(this).val());
    	$('[name="price_material['+rowid+']"]').val(material.selling_price);
    });


    $('.select2').select2();

    $('.number').keypress(function(e){
    	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	        return false;
	    }
    });

    $('#form-add-examination_outpatient').validate();

    $('[data-toggle="tooltip"]').tooltip({html: true});

    $('[name="cost_outpatient"]').change(function(){
    	console.log($(this).val());
    });

    $('[name="price_material"]').change(function(){
    	console.log($(this).val());
    });
}

function onAddRow2()
{
	$('[data-toggle="tooltip"]').tooltip('hide');

	$('#empty-row-lab').remove();

    row_length3 = row_length3 + 1;

    var table = '<tr id="'+ row_length3 +'">' +
									'<td style="width: 35%">'+
										'<div class="form-group clearfix">' +
												'<select name="lab_id['+ row_length3 +']" class="select2 form-control lab-id" required="required" data-placeholder="Pilih Lab">'+
												'<option value=""></option></select>'+
												'<span class="help-block"></span>' +
											'</div>' +
									'</td>' +
									'<td>'+
										'<div class="form-group">' +
											'<div class="input-group">' +
												'<input name="hasil_lab['+ row_length3 +']" type="text" class="form-control text-center" required="required" placeholder="Positif DBD">'+
											'</div>' +
											'<span class="help-block"></span>' +
										'</div>' +
									'</td>' +
									'<td>'+
										'<div class="form-group">' +
											'<div class="input-group">' +
												'<input name="price_lab['+ row_length3 +']" type="text" class="form-control text-center" readonly="readonly" required="required" placeholder="150000" onkeyup="onCalculateAllLab()">'+
											'</div>' +
											'<span class="help-block"></span>' +
										'</div>' +
									'</td>' +
									'<td style="width: 20%">'+
										'<div class="form-group clearfix">' +
											'<select data-id="'+row_length3+'" name="doctor_id_lab['+ row_length3 +']" class="select2 form-control doctor-lab-id" required="required" data-placeholder="Pilih Dokter"></select>'+
											'<span class="help-block"></span>' +
										'</div>' +
									'</td>' +
									'<td style="width:50px" class="text-center"><button type="button" class="btn btn-danger tn-bordered waves-effect waves-light removeRow" data-toggle="tooltip" data-original-title="Hapus"><i class="mdi mdi-close"></i></button></td>' +
                '</tr>';
        
	$('#details-outpatient-lab').append(table);

	let arr_lab = getLab();

	$('.lab-id').select2({
		data: arr_lab
	})
	
	let arr_doctor = getDoctor();

	$('.doctor-lab-id').select2({
		data: arr_doctor
	});

	$('.lab-id').select2({
    	data: arr_labo
    }).on('change', function(){
		var rowid = row_length3;
		var labola = getLabDetail($(this).val());
		$('[name="price_lab['+rowid+']"]').val(labola.harga);
		onCalculateAllLab();
		calculateAllOfData();
	});

	$('#form-add-examination_inpatient').validate();

	$('[data-toggle="tooltip"]').tooltip({html: true});
}

function getLabDetail(id) {
	var res = $.ajax({
		url: SITE_URL+'/examination_outpatient/get-lab-id/'+id,
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}

function onCalculateAllMedicine() {
	let priceTotal = 0;
	$('[name^="total_material"]').each(function() {
		priceTotal += parseInt($(this).val());
	});
	$('[name="amount_material"]').val(priceTotal);
}

function onCalculate(valCostOutpatient, valManyAction, valSum) {
	// console.log(valCostOutpatient);
	// console.log(valManyAction);
	// var total = parseInt(valCostOutpatient) * parseInt(valManyAction);
	// console.log(total);
	// if (isNaN(total)) {
	// 	$('[name="total_action['+valSum+']"]').val(0);
	// } else {
	// 	$('[name="total_action['+valSum+']"]').val(total);
	// }
	// updatePrice();
	// updateTotalPrice();
	var total = parseInt(valCostOutpatient) * parseInt(valManyAction);
	if (isNaN(total)) {
		$('[name="total_action['+valSum+']"]').val(0);
	} else {
		$('[name="total_action['+valSum+']"]').val(total);
	}
	onCalculateAllAction();
	calculateAllOfData();
}

function onCalculate1(valPriceMaterial, valManyMaterial, valSum) {
	// console.log(valPriceMaterial);
	// console.log(valManyMaterial);
	// var total = parseInt(valPriceMaterial) * parseInt(valManyMaterial);
	// console.log(total);
	// if (isNaN(total)) {
	// 	$('[name="total_material['+valSum+']"]').val(0);
	// } else {
	// 	$('[name="total_material['+valSum+']"]').val(total);
	// }
	// updatePrice1();
	// updateTotalPrice();
	var total = parseInt(valPriceMaterial) * parseInt(valManyMaterial);
	if (isNaN(total)) {
		$('[name="total_material['+valSum+']"]').val(0);
	} else {
		$('[name="total_material['+valSum+']"]').val(total);
	}
	onCalculateAllMedicine();
	calculateAllOfData();
}


function getMAterialDetail(id) {
	var res = $.ajax({
		url: SITE_URL+'/examination_outpatient/get-material-id/'+id,
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}

function getActionDetail(id) {
	var res = $.ajax({
		url: SITE_URL+'/examination_outpatient/get-action-id/'+id,
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}

function getOutpatientDetail(id) {
	var res = $.ajax({
		url: SITE_URL+'/examination_outpatient/get-outpatient-id/'+id,
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}

 function getOutpatient()
{
	var res = $.ajax({
		url: SITE_URL + '/examination_outpatient/get_outpatient',
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
	$('[name="registration_date"]').val(outpatient.tgl_periksa);
	$('[name="pasien_id"]').val(outpatient.pasien.name);
	$('[name="doctor_name"]').val(outpatient.doctor.name);
});

//

$("#total_action").change(function(){
	var hasil = 0;
	for (var i = 1; i<=row_length; i++) {
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
	$("#total_action").val(val);
	$("#total_action").trigger('change');
}

function updatePrice2(val)
{
	$("#total_lab").val(val);
	$("#total_lab").trigger('change');
}


$("#total_material").change(function(){
	var hasil = 0;
	for (var i = 1; i<=row_length; i++) {
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

$("#total_lab").change(function(){
	var hasil = 0;
	for (var i = 1; i<=row_length; i++) {
		var total_biaya_lab = document.getElementById('total_lab['+i+']');
		if(total_biaya_lab){
			var total_biaya_lab_value = parseInt(total_biaya_lab.value);
		} else {
			var total_biaya_lab_value = 0;
		}
		hasil = parseInt(hasil + total_biaya_lab_value);
	}
	$(this).val(hasil);
});

function updatePrice1(val)
{
	$("#total_material").val(val);
	$("#total_material").trigger('change');
}

function updateTotalPrice(hasil)
{
	var total_tindakan = parseInt(document.getElementById('total_action').value || 0);
	var total_material = parseInt(document.getElementById('total_material').value || 0);
	var total_lab = parseInt(document.getElementById('total_lab').value || 0);

	var hasil = parseInt(total_tindakan + total_material + total_lab);
	//console.log("Hasilnya : " + hasil);
	$("#total_pembayaran").val(hasil);
	return;
}



// ("#total_action1").change(function(){
// 	var hasil = 0;
// 	for (var i = 1; i<=i; i++) {
// 		var total_biaya_tindakan = document.getElementById('total_action['+i+']');
// 		if(total_biaya_tindakan){
// 			var total_biaya_tindakan_value = parseInt(total_biaya_tindakan.value);
// 		} else {
// 			var total_biaya_tindakan_value = 0;
// 		}
// 		hasil = parseInt(hasil + total_biaya_tindakan_value);
// 	}
// 	$(this).val(hasil);
// });

// function updatePrice(val)
// {
// 	$("#total_action1").val(val);
// 	$("#total_action1").trigger('change');
// }


// $("#total_material1").change(function(){
// 	var hasil = 0;
// 	for (var i = 1; i<=i; i++) {
// 		var total_biaya_material = document.getElementById('total_material['+i+']');
// 		if(total_biaya_material){
// 			var total_biaya_material_value = parseInt(total_biaya_material.value);
// 		} else {
// 			var total_biaya_material_value = 0;
// 		}
// 		hasil = parseInt(hasil + total_biaya_material_value);
// 	}
// 	$(this).val(hasil);
// });

// function updatePrice1(val)
// {
// 	$("#total_material1").val(val);
// 	$("#total_material1").trigger('change');
// }

// function updateTotalPrice(hasil)
// {
// 	var total_tindakan = parseInt(document.getElementById('total_action').value || 0);
// 	var total_material = parseInt(document.getElementById('total_material').value || 0);
// 	var hasil = parseInt(total_tindakan + total_material);
// 	//console.log("Hasilnya : " + hasil);
// 	$("#total_pembayaran1").val(hasil);
// 	return;
// }

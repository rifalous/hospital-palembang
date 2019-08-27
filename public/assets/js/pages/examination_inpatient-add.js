var row_length = parseInt($('[name="last_index"]').val());
var row_length2 = parseInt($('[name="last_index_2"]').val());
var row_length3 = parseInt($('[name="last_index_3"]').val());
var arr_action = [];
var arr_material = [];

$(document).ready(function(){
	onCalculateAllAction();
	onCalculateAllMedicine();
	onCalculateAllLab();
	calculateAllOfData();

	$('#details-inpatient-table').on('click', '.removeRow', function(){
		var init_length = $('#details-inpatient-table > tbody > tr').length;

		if (init_length <= 1) {
				$('#details-inpatient-table > tbody').append('<tr class="text-center" id="empty-row"><td colspan="6">No data</td></tr>');
		}

		$(this).parent().parent().remove();
		onCalculateAllAction();
		onCalculateAllMedicine();
		onCalculateAllLab();
		calculateAllOfData();
	});

	$('#details-inpatient-material').on('click', '.removeRow', function(){
		var init_length = $('#details-inpatient-material > tbody > tr').length;

		if (init_length <= 1) {
				$('#details-inpatient-material > tbody').append('<tr class="text-center" id="empty-row-medicine"><td colspan="8">No data</td></tr>');
		}

		$(this).parent().parent().remove();
		onCalculateAllAction();
		onCalculateAllMedicine();
		onCalculateAllLab();
		calculateAllOfData();
	});

	$('#details-inpatient-lab').on('click', '.removeRow', function(){
		var init_length = $('#details-inpatient-lab > tbody > tr').length;

		if (init_length <= 1) {
				$('#details-inpatient-lab > tbody').append('<tr class="text-center" id="empty-row-lab"><td colspan="5">No data</td></tr>');
		}

		$(this).parent().parent().remove();
		onCalculateAllAction();
		onCalculateAllMedicine();
		onCalculateAllLab();
		calculateAllOfData();
	});

	$('[name="inpatient_id"]').change(function(){
		$.ajax({
			url: SITE_URL + '/examination_inpatient/get_inpatient',
			type: 'get',
			dataType: 'json',
			data: {
				no_registrasi: $(this).val(),
				id: $('[name="id"]').val()
			},
			success: function(data) {
				$('[name="tgl_masuk"]').val(data.tgl_masuk);
				$('[name="room_id"]').val(data.room.id).change();
				$('[name="class_id"]').val(data.room.level_id).change();
				$('[name="doctor_name"]').val(data.doctor.name).change();

			}
		});
	});

	$('#form-add-examination_inpatient').validate({
		rules: {
        code: {
            remote: {
                    url: SITE_URL + 'examination_inpatient/validate',
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

function getAction()
{
	var res = $.ajax({
		url: SITE_URL + '/examination_inpatient/get_action',
		type: 'get',
		dataType: 'json',
		async: false,
	});
	return res.responseJSON;
}

function getMedicine()
{
	var res = $.ajax({
		url: SITE_URL + '/examination_inpatient/get_medicine',
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

function getMedicineTime()
{
	var res = $.ajax({
		url: SITE_URL + '/examination_inpatient/get_medicine_time',
		type: 'get',
		dataType: 'json',
		async: false,
	});

	return res.responseJSON;
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

function onCalculateAllMedicine() {
	let priceTotal = 0;
	$('[name^="total_material"]').each(function() {
		priceTotal += parseInt($(this).val());
	});
	$('[name="amount_material"]').val(priceTotal);
}

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

function onAddRow()
{

	
	$('[data-toggle="tooltip"]').tooltip('hide');

	$('#empty-row').remove();

    row_length = row_length + 1;

    var table = '<tr id="'+ row_length +'">' +
                     '<td style="width: 35%">'+
                     	'<div class="form-group clearfix">' +
                        	'<select name="action_id['+ row_length +']" class="select2 form-control action-id" required="required" data-placeholder="Pilih Tindakan"><option value="">-- Pilih Tindakan --</option></select>'+
                        	'<span class="help-block"></span>' +
                        '</div>' +
                    '</td>' +
                    '<td>'+
						'<div class="form-group">' +
	                		'<div class="input-group">' +
							  '<input name="cost_inpatient['+ row_length +']" type="text" class="form-control text-center number" required="required" placeholder="0" onkeyup="onCalculate(this.value, document.getElementsByName(\'many_action['+ row_length +']\')[0].value, '+row_length+')">'+
							'</div>' +
							'<span class="help-block"></span>' +
						'</div>' +
                    '</td>' +
                    '<td>'+
						'<div class="form-group">' +
	                		'<div class="input-group">' +
							  '<input name="many_action['+ row_length +']" type="text" class="form-control text-center" required="required" placeholder="0" onkeyup="onCalculate(this.value, document.getElementsByName(\'cost_inpatient['+ row_length +']\')[0].value, '+row_length+')">'+
							'</div>' +
							'<span class="help-block"></span>' +
						'</div>' +
                    '</td>' +
                    '<td>'+
						'<div class="form-group">' +
	                		'<div class="input-group">' +
							  '<input name="total_action['+ row_length +']" type="text" value="0" class="form-control text-center" readOnly="readOnly" required="required" placeholder="Jumlah Tindakan">'+
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
        
    $('#details-inpatient-table').append(table);

    let arr_doctor = getDoctor();

    $('.doctor-id').select2({
    	data: arr_doctor
    });

	arr_action = getAction();
    $('.action-id').select2({
    	data: arr_action
    });

    $('.number').keypress(function(e){
    	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	        return false;
	    }
	    
    });

    $('#form-add-examination_inpatient').validate();

    $('[data-toggle="tooltip"]').tooltip({html: true});

    $('[name="cost_inpatient"]').change(function(){
    	console.log($(this).val());
    });

    $('[name="price_material"]').change(function(){
    	console.log($(this).val());
    });
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

function onAddRow1()
{
	$('[data-toggle="tooltip"]').tooltip('hide');

	$('#empty-row-medicine').remove();

    row_length2 = row_length2 + 1;

    var table = '<tr id="'+ row_length2 +'">' +
									'<td style="width: 35%">'+
										'<div class="form-group clearfix">' +
												'<select name="material_id['+ row_length2 +']" class="select2 form-control material-id" required="required" data-placeholder="Pilih Bahan/Obat">'+
												'<option value=""></option></select>'+
												'<span class="help-block"></span>' +
											'</div>' +
									'</td>' +
									'<td>'+
										'<div class="form-group"> '+
											'<div class="input-group"> ' +
												'<input name="tanggal['+row_length2+']" type="text" class="form-control date" required="required" placeholder="2019-01-03" value="">' +
											'</div> '+
											'<span class="help-block"></span> '+
										'</div> '+
									'</td>'+
									'<td style="width: 10%">'+
										'<div class="form-group clearfix">' +
												'<select name="waktu['+ row_length2 +']" class="select2 form-control waktu-id" required="required" data-placeholder="-- Pilih Waktu --" style="max-width:50px;">'+
												'<option value=""></option></select>'+
												'<span class="help-block"></span>' +
											'</div>' +
									'</td>' +
									'<td>'+
										'<div class="form-group">' +
											'<div class="input-group">' +
												'<input name="price_material['+ row_length2 +']" type="text" class="form-control text-center" required="required" placeholder="3000" onkeyup="onCalculate1(this.value, document.getElementsByName(\'many_material['+ row_length2 +']\')[0].value, '+row_length2+')">'+
											'</div>' +
											'<span class="help-block"></span>' +
										'</div>' +
									'</td>' +
									'<td>'+
										'<div class="form-group">' +
	                		'<div class="input-group">' +
							  				'<input name="many_material['+ row_length2 +']" type="text" class="form-control text-center" required="required" placeholder="10" onkeyup="onCalculate1(this.value, document.getElementsByName(\'price_material['+ row_length2 +']\')[0].value, '+row_length2+')">'+
											'</div>' +
											'<span class="help-block"></span>' +
										'</div>' +
									'</td>' +
									'<td>'+
										'<div class="form-group">' +
	                		'<div class="input-group">' +
							  				'<input name="total_material['+ row_length2 +']" type="text" value="0" class="form-control text-center" readOnly="readOnly" required="required" placeholder="Jumlah Tindakan">'+
											'</div>' +
											'<span class="help-block"></span>' +
										'</div>' +
									'</td>' +
									'<td>'+
										'<div class="form-group">' +
	                		'<div class="input-group">' +
							  				'<input name="medicine_giver['+ row_length2 +']" type="text" class="form-control text-center" required="required" placeholder="Pemberi Obat">'+
											'</div>' +
											'<span class="help-block"></span>' +
										'</div>' +
									'</td>' +
									'<td style="width:50px" class="text-center"><button type="button" class="btn btn-danger tn-bordered waves-effect waves-light removeRow" data-toggle="tooltip" data-original-title="Hapus"><i class="mdi mdi-close"></i></button></td>' +
                '</tr>';
        
    $('#details-inpatient-material').append(table);

    let arr_medicine = getMedicine();

    $('.material-id').select2({
    	data: arr_medicine
    })

    let arr_medicine_time = getMedicineTime();

    $('.waktu-id').select2({
    	data: arr_medicine_time
    })


		$('.select2').select2();
		
		$('.date').datepicker({  
			format: 'yyyy-mm-dd'
		});  

    $('.number').keypress(function(e){
    	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	        return false;
	    }
    });

    $('#form-add-examination_inpatient').validate();

    $('[data-toggle="tooltip"]').tooltip({html: true});

    $('[name="cost_inpatient"]').change(function(){
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
												'<input name="price_lab['+ row_length3 +']" type="text" class="form-control text-center" required="required" placeholder="150000" onkeyup="onCalculateAllLab()">'+
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
        
    $('#details-inpatient-lab').append(table);

    let arr_lab = getLab();

    $('.lab-id').select2({
    	data: arr_lab
    })
		
		let arr_doctor = getDoctor();

    $('.doctor-lab-id').select2({
    	data: arr_doctor
    });

    $('#form-add-examination_inpatient').validate();

    $('[data-toggle="tooltip"]').tooltip({html: true});
}

function onCalculate(valCostinpatient, valManyAction, valSum) {
	var total = parseInt(valCostinpatient) * parseInt(valManyAction);
	if (isNaN(total)) {
		$('[name="total_action['+valSum+']"]').val(0);
	} else {
		$('[name="total_action['+valSum+']"]').val(total);
	}
	onCalculateAllAction();
	calculateAllOfData();
}

function onCalculate1(valPriceMaterial, valManyMaterial, valSum) {
	var total = parseInt(valPriceMaterial) * parseInt(valManyMaterial);
	if (isNaN(total)) {
		$('[name="total_material['+valSum+']"]').val(0);
	} else {
		$('[name="total_material['+valSum+']"]').val(total);
	}
	onCalculateAllMedicine();
	calculateAllOfData();
}
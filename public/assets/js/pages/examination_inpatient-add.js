var row_length = parseInt($('[name="last_index"]').val());
var arr_action = [];
var arr_material = [];

$(document).ready(function(){
	$('#details-inpatient-table').on('click', '.removeRow', function(){

	    var init_length = $('#details-inpatient-table > tbody > tr').length;

	    if (init_length <= 1) {
	        $('#details-inpatient-table > tbody').append('<tr class="text-center" id="empty-row"><td colspan="6">No data</td></tr>');
	    }

	    $(this).parent().parent().remove();

	});

	$('#details-inpatient-material').on('click', '.removeRow', function(){

	    var init_length = $('#details-inpatient-material > tbody > tr').length;

	    if (init_length <= 1) {
	        $('#details-inpatient-material > tbody').append('<tr class="text-center" id="empty-row"><td colspan="5">No data</td></tr>');
	    }

	    $(this).parent().parent().remove();

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
				$('[name="check_date"]').val(data);
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

    arr_action = getAction();

    $('.action-id').select2({
    	data: arr_action
    })

    $('.select2').select2();

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

function onAddRow1()
{
	$('[data-toggle="tooltip"]').tooltip('hide');

	$('#empty-row').remove();

    row_length = row_length + 1;

    var table = '<tr id="'+ row_length +'">' +
                    '<td style="width: 35%">'+
                     	'<div class="form-group clearfix">' +
                        	'<select name="material_id['+ row_length +']" class="select2 form-control material-id" required="required" data-placeholder="Pilih Bahan/Obat">'+
                        	'<option value=""></option></select>'+
                        	'<span class="help-block"></span>' +
                        '</div>' +
                    '</td>' +
                    '<td>'+
						'<div class="form-group">' +
	                		'<div class="input-group">' +
							  '<input name="price_material['+ row_length +']" type="text" class="form-control text-center" required="required" placeholder="0" onkeyup="onCalculate1(this.value, document.getElementsByName(\'many_material['+ row_length +']\')[0].value, '+row_length+')">'+
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
							  '<input name="total_material['+ row_length +']" type="text" value="0" class="form-control text-center" readOnly="readOnly" required="required" placeholder="Jumlah Tindakan">'+
							'</div>' +
							'<span class="help-block"></span>' +
						'</div>' +
                    '</td>' +
                    '<td style="width:50px" class="text-center"><button type="button" class="btn btn-danger tn-bordered waves-effect waves-light removeRow" data-toggle="tooltip" data-original-title="Hapus"><i class="mdi mdi-close"></i></button></td>' +
                '</tr>';
        
    $('#details-inpatient-material').append(table);

    arr_medicine = getMedicine();

    $('.material-id').select2({
    	data: arr_medicine
    })


    $('.select2').select2();

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

function onCalculate(valCostinpatient, valManyAction, valSum) {
	console.log(valCostinpatient);
	console.log(valManyAction);
	var total = parseInt(valCostinpatient) * parseInt(valManyAction);
	console.log(total);
	if (isNaN(total)) {
		$('[name="total_action['+valSum+']"]').val(0);
	} else {
		$('[name="total_action['+valSum+']"]').val(total);
	}
}

function onCalculate1(valPriceMaterial, valManyMaterial, valSum) {
	console.log(valPriceMaterial);
	console.log(valManyMaterial);
	var total = parseInt(valPriceMaterial) * parseInt(valManyMaterial);
	console.log(total);
	if (isNaN(total)) {
		$('[name="total_material['+valSum+']"]').val(0);
	} else {
		$('[name="total_material['+valSum+']"]').val(total);
	}
}
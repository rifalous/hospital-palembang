var thumb;
var row_length = parseInt($('[name="last_index"]').val());

$(document).ready(function(){
	$('#form-add-edit').validate();
	
	$('.btn-open-media').click(function(){
		$('#modal-media').modal('show');
		thumb = $(this).data('index');
	});

	$('#btn-use').click(function(){

		var img = $('.image-browser').find('.selected').children().attr('src');
		var id = $('.image-browser').find('.selected').children().data('value');
		var filename = $('.image-browser').find('.selected').children().data('name');

		if (thumb == undefined) {
			$('[name="feature_image"]').val(filename);
		} else {
			$('[name="thumb['+thumb+']"]').val(filename);
		}
		
		get_data();
		$('.details').hide();

	});


	$('#btn-add-rows').click(function(){

		var table;
		$('#empty-row').remove();

		row_length = row_length + 1;
		
		table = '<tr id="'+ row_length +'">' +
                    '<td>' +
                        '<div class="form-group">' +
                            '<input type="text" name="type['+ row_length +']" class="form-control" required="required">' +
                            '<span class="help-block"></span>' +
                        '</div>' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="price['+ row_length +']" class="form-control autonumeric">' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="size['+ row_length +']" class="form-control">' +
                    '</td>' +
                    '<td>' +
                        '<div class="input-group">' +
                            '<input type="text" class="form-control" placeholder="Feature Image" readonly="readonly" name="thumb['+ row_length +']">' +
                            '<span class="input-group-btn">' +
                                '<button class="btn btn-default btn-bordered waves-light waves-light btn-open-media" type="button" data-index="'+ row_length +'">Browse</button>' +
                            '</span>' +
                        '</div>' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="Description['+ row_length +']" class="form-control">' +
                    '</td>' +
                    '<td><button class="btn btn-link text-danger" onclick="remove_row('+row_length+')"><i class="fa fa-times"></i></button></td>' +
                '</tr>';

        $('#tbl-details tbody').append(table);

        $('.btn-open-media').click(function(){
			$('#modal-media').modal('show');
			thumb = $(this).data('index');
		});

		$('.autonumeric').autoNumeric();

	});


});
var tType;
$(document).ready(function(){

	tType = $('#table-part-category').DataTable({
		ajax: SITE_URL + '/part_category/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'part_category_code', name: 'part_category_code'},
            { data: 'part_category_name', name: 'part_category_name'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var part_category_id = $(this).data('value');
        $('#form-delete-' + part_category_id).submit();
    });

});

function on_delete(part_category_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', part_category_id);
}
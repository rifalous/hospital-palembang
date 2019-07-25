var tDepartment;
$(document).ready(function(){

	tRate = $('#table-part').DataTable({
		ajax: SITE_URL + '/part/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'part_number', name: 'part_number'},
            { data: 'part_name', name: 'part_name'},
            { data: 'uom', name: 'uom'},
            { data: 'plant', name: 'plant'},
            { data: 'category_part', name: 'category_part'},
            { data: 'product_code', name: 'product_code'},
            { data: 'category_fg', name: 'category_fg'},
            { data: 'assy_part', name: 'assy_part'},
            { data: 'group_material', name: 'group_material'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var part_id = $(this).data('value');
        $('#form-delete-' + part_id).submit();
    });

});

function on_delete(part_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', part_id);
}

function on_import()
{
    $('#modal-import').modal('show');
}

$('#btn-import').click(function(){
    $('#form-import').submit();
});

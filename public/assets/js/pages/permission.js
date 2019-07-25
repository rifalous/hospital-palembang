var tPermission;
$(document).ready(function(){
	tPermission = $('#tbl-permission').DataTable({
		ajax: SITE_URL + '/settings/permission/get_data',
        columns: [
            { data: 'display_name', name: 'display_name'},
            { data: 'parent', name: 'parent'},
            { data: 'description', name: 'description' },
            { data: 'options', name: 'options', class: 'text-center' },
        ],
	});

	$('#btn-confirm').click(function(){
		var id = $(this).data('id');
		$('#form-delete-'+id).submit();
	});


});

function on_delete(id)
{
	$('#modal-delete-confirm').modal('show');
	$('#btn-confirm').data('id', id);
}
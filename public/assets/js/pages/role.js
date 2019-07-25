var tRole;
$(document).ready(function(){
	tRole = $('#tbl-role').DataTable({
		ajax: SITE_URL + '/settings/role/get_data',
        columns: [
            { data: 'title', name: 'title'},
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
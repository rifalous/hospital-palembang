var tManageApproval;
$(document).ready(function(){
	tManageApproval = $('#tbl-manage_approval').DataTable({
		ajax: SITE_URL + 'manage_approval/get_data',
        columns: [
            { data: 'approval_name', name: 'approval_name'},
            { data: 'department_id', name: 'department_id' },
            { data: 'level', name: 'level' },
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
function on_delete(user_id)
{
	$('#modal-delete-confirm').modal('show');
	$('#btn-confirm').data('value', user_id);
}

function on_import()
{
	$('#modal-import').modal('show');
}

$('#btn-confirm').click(function(){
	var user_id = $(this).data('value');
	$('#form-delete-' + user_id).submit();
});

$('#btn-import').click(function(){
	$('#form-import').submit();
});
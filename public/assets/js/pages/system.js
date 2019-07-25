var tType;
$(document).ready(function(){

	tType = $('#table-system').DataTable({
		ajax: SITE_URL + '/system/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'system_type', name: 'system_type'},
            { data: 'system_code', name: 'system_code'},
            { data: 'system_val', name: 'system_val'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var system_id = $(this).data('value');
        $('#form-delete-' + system_id).submit();
    });

});

function on_delete(system_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', system_id);
}
var tAction;
$(document).ready(function(){

	tRate = $('#table-action').DataTable({
		ajax: SITE_URL + '/action/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'action', name: 'action'},
            { data: 'level.class', name: 'level.class'},
            { data: 'material', name: 'material'},
            { data: 'service_rs', name: 'service_rs'},
            { data: 'service_medis', name: 'service_medis'},
            { data: 'service_anestesi', name: 'service_anestesi'},
            { data: 'service_dll', name: 'service_dll'},
            { data: 'total', name: 'total'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var action_id = $(this).data('value');
        $('#form-delete-' + action_id).submit();
    });

});

function on_delete(action_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', action_id);
}
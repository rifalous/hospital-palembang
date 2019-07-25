var tRoom;
$(document).ready(function(){

	tRate = $('#table-room').DataTable({
		ajax: SITE_URL + '/room/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'code', name: 'code'},
            { data: 'name', name: 'name'},
            { data: 'level.class', name: 'level.class'},
            { data: 'total_place_number', name: 'total_place_number'},
            { data: 'place_resource', name: 'place_resource'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var room_id = $(this).data('value');
        $('#form-delete-' + room_id).submit();
    });

});

function on_delete(room_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', room_id);
}
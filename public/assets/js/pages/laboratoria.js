var tLaboratoria;
$(document).ready(function(){

	tRate = $('#table-laboratoria').DataTable({
		ajax: SITE_URL + '/laboratoria/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'keterangan', name: 'keterangan'},
            { data: 'harga', name: 'harga'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var laboratoria_id = $(this).data('value');
        $('#form-delete-' + laboratoria_id).submit();
    });

});

function on_delete(action_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', action_id);
}
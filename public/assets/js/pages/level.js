var tLevel;
$(document).ready(function(){

	tRate = $('#table-level').DataTable({
		ajax: SITE_URL + '/level/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'code', name: 'code'},
            { data: 'class', name: 'class'},
            { data: 'tarif', name: 'tarif'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var level_id = $(this).data('value');
        $('#form-delete-' + level_id).submit();
    });

});

function on_delete(level_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', level_id);
}
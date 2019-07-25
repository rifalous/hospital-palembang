var tType;
$(document).ready(function(){

	tType = $('#table-division').DataTable({
		ajax: SITE_URL + '/division/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'division_code', name: 'division_code'},
            { data: 'division_name', name: 'division_name'},
            { data: 'dir_key', name: 'dir_key'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var division_id = $(this).data('value');
        $('#form-delete-' + division_id).submit();
    });

});

function on_delete(division_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', division_id);
}

function on_import()
{
    $('#modal-import').modal('show');
}

$('#btn-import').click(function(){
    $('#form-import').submit();
});
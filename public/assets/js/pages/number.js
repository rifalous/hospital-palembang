var tNumber;
$(document).ready(function(){

	tNumber = $('#table-number').DataTable({
		ajax: SITE_URL + '/number/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'number_type', name: 'number_type'},
            { data: 'number_booked', name: 'number_booked'},
            { data: 'number_current', name: 'number_current'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var number_id = $(this).data('value');
        $('#form-delete-' + number_id).submit();
    });

});

function on_delete(number_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', number_id);
}

function on_import()
{
    $('#modal-import').modal('show');
}

$('#btn-import').click(function(){
    $('#form-import').submit();
});
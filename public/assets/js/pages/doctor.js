var tDoctor;
$(document).ready(function(){

	tRate = $('#table-doctor').DataTable({
		ajax: SITE_URL + '/doctor/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'code', name: 'code'},
            { data: 'nip', name: 'nip'},
            { data: 'name', name: 'name'},
            { data: 'address', name: 'address'},
            { data: 'phone', name: 'phone'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var doctor_id = $(this).data('value');
        $('#form-delete-' + doctor_id).submit();
    });

});

function on_delete(doctor_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', doctor_id);
}
var tDepartment;
$(document).ready(function(){

	tRate = $('#table-department').DataTable({
		ajax: SITE_URL + '/department/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'department_code', name: 'department_code'},
            { data: 'department_name', name: 'department_name'},
            { data: 'division.division_name', name: 'division.division_name'},
            { data: 'division.dir_key', name: 'division.dir_key'},
            { data: 'sap_key', name: 'sap_key'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var department_id = $(this).data('value');
        $('#form-delete-' + department_id).submit();
    });

});

function on_delete(department_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', department_id);
}
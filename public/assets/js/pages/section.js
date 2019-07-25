var tSection;
$(document).ready(function(){

	tRate = $('#table-section').DataTable({
		ajax: SITE_URL + '/section/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'section_code', name: 'section_code'},
            { data: 'section_name', name: 'section_name'},
            { data: 'department.department_name', name: 'department.department_name'},
            { data: 'department.division.division_name', name: 'department.division.division_name'},
            { data: 'department.division.dir_key', name: 'department.division.dir_key'},
            { data: 'department.sap_key', name: 'department.sap_key'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var section_id = $(this).data('value');
        $('#form-delete-' + section_id).submit();
    });

});

function on_delete(section_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', section_id);
}
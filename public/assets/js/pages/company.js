var tCompany;
$(document).ready(function(){

	tRate = $('#table-company').DataTable({
		ajax: SITE_URL + '/company/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'code', name: 'code'},
            { data: 'name', name: 'name'},
            { data: 'address', name: 'address'},
            { data: 'city', name: 'city'},
            { data: 'division.division_name', name: 'division.division_name'},
            
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var company_id = $(this).data('value');
        $('#form-delete-' + company_id).submit();
    });

});

function on_delete(company_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', company_id);
}
var tType;
$(document).ready(function(){

	tType = $('#table-customer').DataTable({
		ajax: SITE_URL + '/customer/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'customer_code', name: 'customer_code'},
            { data: 'customer_name', name: 'customer_name'},
            { data: 'customer_address', name: 'customer_address'},
            { data: 'customer_phone', name: 'customer_phone'},
            { data: 'customer_email', name: 'customer_email'},
            { data: 'customer_website', name: 'customer_website'},
            { data: 'customer_pic_name', name: 'customer_pic_name'},
            { data: 'customer_pic_phone', name: 'customer_pic_phone'},
            { data: 'customer_pic_email', name: 'customer_pic_email'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var customer_id = $(this).data('value');
        $('#form-delete-' + customer_id).submit();
    });

});

function on_delete(customer_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', customer_id);
}

function on_import()
{
    $('#modal-import').modal('show');
}

$('#btn-import').click(function(){
    $('#form-import').submit();
});
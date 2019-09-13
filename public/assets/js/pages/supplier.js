var tType;
$(document).ready(function(){

	tType = $('#table-supplier').DataTable({
		ajax: SITE_URL + '/supplier/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'supplier_code', name: 'supplier_code'},
            { data: 'supplier_name', name: 'supplier_name'},
            { data: 'supplier_address', name: 'supplier_address'},
            { data: 'supplier_phone', name: 'supplier_phone'},
            { data: 'supplier_email', name: 'supplier_email'},
            { data: 'supplier_website', name: 'supplier_website'},
            { data: 'supplier_pic_name', name: 'supplier_pic_name'},
            { data: 'supplier_pic_phone', name: 'supplier_pic_phone'},
            { data: 'supplier_pic_email', name: 'supplier_pic_email'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        scrollCollapse: true,
            scrollX: '100%',
        drawCallback: function(){
			$('[data-toggle="tooltip"]').tooltip({
				'container': 'body'
		});
		}
	});


    $('#btn-confirm').click(function(){
        var supplier_id = $(this).data('value');
        $('#form-delete-' + supplier_id).submit();
    });

});

function on_delete(supplier_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', supplier_id);
}

function on_import()
{
    $('#modal-import').modal('show');
}

$('#btn-import').click(function(){
    $('#form-import').submit();
});
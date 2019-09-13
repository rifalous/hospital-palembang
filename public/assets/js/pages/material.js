var tMaterial;
$(document).ready(function(){

	tRate = $('#table-material').DataTable({
		ajax: SITE_URL + '/material/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'code', name: 'code'},
            { data: 'name', name: 'name'},
            { data: 'packaging', name: 'packaging'},
            { data: 'fill_in', name: 'fill_in'},
            { data: 'unit', name: 'unit'},
            { data: 'minimum_stock', name: 'minimum_stock'},
            { data: 'group', name: 'group'},
            { data: 'type', name: 'type'},
            { data: 'supplier.supplier_name', name: 'supplier.supplier_name'},
            { data: 'purchase_price', name: 'purchase_price'},
            { data: 'selling_price', name: 'selling_price'},
            { data: 'profit', name: 'profit'},
            { data: 'recipe_prices', name: 'recipe_prices'},
            { data: 'profit_persen', name: 'profit_persen'},
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
        var material_id = $(this).data('value');
        $('#form-delete-' + material_id).submit();
    });

});

function on_delete(material_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', material_id);
}
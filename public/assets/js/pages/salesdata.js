var tSalesData;
$(document).ready(function(){

	tSalesData = $('#table-salesdata').DataTable({
		ajax: SITE_URL + '/salesdata/get_data',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        scrollX: true,
        columns: [

            { data: 'fiscal_year', name: 'fiscal_year'},
            { data: 'parts.part_number', name: 'parts.part_number'},
            { data: 'customers.customer_code', name: 'customers.customer_code'},
            { data: 'market', name: 'market'},
            { data: 'apr_qty', name: 'apr_qty', class: 'text-right'},
            { data: 'apr_amount', name: 'apr_amount' ,class: 'text-right'},
            { data: 'may_qty', name: 'may_qty' ,class: 'text-right'},
            { data: 'may_amount', name: 'may_amount' ,class: 'text-right'},
            { data: 'june_qty', name: 'june_qty' ,class: 'text-right'},
            { data: 'june_amount', name: 'june_amount' ,class: 'text-right'},
            { data: 'july_qty', name: 'july_qty' ,class: 'text-right'},
            { data: 'july_amount', name: 'july_amount' ,class: 'text-right'},
            { data: 'august_qty', name: 'august_qty' ,class: 'text-right'},
            { data: 'august_amount', name: 'august_amount' ,class: 'text-right'},
            { data: 'sep_qty', name: 'sep_qty' ,class: 'text-right'},
            { data: 'sep_amount', name: 'sep_amount' ,class: 'text-right'},
            { data: 'okt_qty', name: 'okt_qty' ,class: 'text-right'},
            { data: 'okt_amount', name: 'okt_amount' ,class: 'text-right'},
            { data: 'nov_qty', name: 'nov_qty' ,class: 'text-right'},
            { data: 'nov_amount', name: 'nov_amount' ,class: 'text-right'},
            { data: 'des_qty', name: 'des_qty' ,class: 'text-right'},
            { data: 'des_amount', name: 'des_amount' ,class: 'text-right'},
            { data: 'jan_qty', name: 'jan_qty' ,class: 'text-right'},
            { data: 'jan_amount', name: 'jan_amount' ,class: 'text-right'},
            { data: 'feb_qty', name: 'feb_qty' ,class: 'text-right'},
            { data: 'feb_amount', name: 'feb_amount' ,class: 'text-right'},
            { data: 'mar_qty', name: 'mar_qty' ,class: 'text-right'},
            { data: 'mar_amount', name: 'mar_amount' ,class: 'text-right'},

            
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],

        
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }


	});


    
    
    

    $('#btn-confirm').click(function(){
        var salesdata_id = $(this).data('value');
        $('#form-delete-' + salesdata_id).submit();
    });

});

function on_delete(salesdata_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', salesdata_id);
}

function on_import()
{
    $('#modal-import').modal('show');
}

$('#btn-confirm').click(function(){
    var salesdata_id= $(this).data('value');
    $('#form-delete-' + salesdata_id).submit();
});

$('#btn-import').click(function(){
    $('#form-import').submit();
});

var tTemporarySalesData;
$(document).ready(function(){

    tTemporarySalesData = $('#table-temporary-salesdata').DataTable({
        ajax: SITE_URL + '/salesdata/get_data_temporary',
        scrollX: true,
        columns: [
            { data: 'fiscal_year', name: 'fiscal_year'},
            { data: 'parts.part_number', name: 'parts.part_number'},
            { data: 'customers.customer_code', name: 'customers.customer_code'},
            { data: 'market', name: 'market'},
            { data: 'apr_qty', name: 'apr_qty'},
            { data: 'apr_amount', name: 'apr_amount'},
            { data: 'may_qty', name: 'may_qty'},
            { data: 'may_amount', name: 'may_amount'},
            { data: 'june_qty', name: 'june_qty'},
            { data: 'june_amount', name: 'june_amount'},
            { data: 'july_qty', name: 'july_qty'},
            { data: 'july_amount', name: 'july_amount'},
            { data: 'august_qty', name: 'august_qty'},
            { data: 'august_amount', name: 'august_amount'},
            { data: 'sep_qty', name: 'sep_qty'},
            { data: 'sep_amount', name: 'sep_amount'},
            { data: 'okt_qty', name: 'okt_qty'},
            { data: 'okt_amount', name: 'okt_amount'},
            { data: 'nov_qty', name: 'nov_qty'},
            { data: 'nov_amount', name: 'nov_amount'},
            { data: 'des_qty', name: 'des_qty'},
            { data: 'des_amount', name: 'des_amount'},
            { data: 'jan_qty', name: 'jan_qty'},
            { data: 'jan_amount', name: 'jan_amount'},
            { data: 'feb_qty', name: 'feb_qty'},
            { data: 'feb_amount', name: 'feb_amount'},
            { data: 'mar_qty', name: 'mar_qty'},
            { data: 'mar_amount', name: 'mar_amount'},
        ],
    });
});
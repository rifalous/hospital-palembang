var tOutpatient;
$(document).ready(function(){

	tOutpatient = $('#table-examination-outpatient').DataTable({
		ajax: SITE_URL + '/examination_outpatient/get_data',
        columns: [
            {
                "className":      'details-control',
                "orderable":      false,
                "searchable":     true,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'pasien_name', name: 'pasien_name'},
            { data: 'check_date', name: 'check_date'},
            { data: 'amount_action', name: 'amount_action'},
            { data: 'amount_material', name: 'amount_material'},
            { data: 'amount', name: 'amount'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        order: [1, 'asc'],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#table-examination-outpatient tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tOutpatient.row(tr);
        var tableId = 'posts-' + row.data().id;
        var tableId1 = 'posts1-' + row.data().id;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
            initTable1(tableId1, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
        }
    });

    function initTable(tableId, data) {
        $('#' + tableId).DataTable({
            /*processing: true,
            serverSide: true,*/
            ajax: data.details_url,
            columns: [
              
               
               { data: 'material.name', name: 'material.name'},
               { data: 'price_material', name: 'price_material'},
               { data: 'many_material', name: 'many_material'},
               { data: 'total_material', name: 'total_material'},
                   
               
            ],
            ordering: false,
            searching: false,
            paging: true,
            info: false
        });
    }

    function initTable1(tableId1, data) {
        $('#' + tableId1).DataTable({
            /*processing: true,
            serverSide: true,*/
            ajax: data.details_url1,
            columns: [
              
               { data: 'action.action', name: 'action.action'},
               { data: 'cost_outpatient', name: 'cost_outpatient'},
               { data: 'many_action', name: 'many_action'},
               { data: 'total_action', name: 'total_action'},
               { data: 'doctor.name', name: 'doctor.name'},
                   
               
            ],
            ordering: false,
            searching: false,
            paging: true,
            info: false
        });
    }

     function template(d) {

        console.log(d);

        return `

                <table class="table details-table" id="posts-${d.id}">
                    <thead>
                    <tr>
                        <th>Obat</th>
                        <th>Harga</th>
                        <th>Banyak</th>
                        <th>Total</th>
                        
                    </tr>


            </table>

            <table class="table details-table1" id="posts1-${d.id}">
                    <thead>
                    <tr>
                        <th>Tindakan</th>
                        <th>Biaya</th>
                        <th>Banyak</th>
                        <th>Total</th>
                        <th>Nama Dokter</th>
                        
                    </tr>


            </table>

        `;
    }

    $('#btn-confirm').click(function(){
        var examination_outpatient_id = $(this).data('value');
        $('#form-delete-' + examination_outpatient_id).submit();
    });

});

function on_delete(examination_outpatient_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', examination_outpatient_id);
}

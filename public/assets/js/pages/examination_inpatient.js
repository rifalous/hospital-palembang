var tOutpatient;
$(document).ready(function(){

	tOutpatient = $('#table-examination-inpatient').DataTable({
		ajax: SITE_URL + '/examination_inpatient/get_data',
        columns: [
            {
                "className":      'details-control',
                "orderable":      false,
                "searchable":     true,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'pasien_name', name: 'pasien_name'},
            { data: 'tgl_periksa', name: 'tgl_periksa'},
            { data: 'doktor_name', name: 'doktor_name'},
            { data: 'disease', name: 'disease'},
            { data: 'complaint', name: 'complaint'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        order: [1, 'asc'],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#table-examination-inpatient tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tOutpatient.row(tr);
        var tableId = 'posts-' + row.data().id;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
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
              
               { data: 'action_id', name: 'action_id'},
               { data: 'cost_outpatient', name: 'cost_outpatient'},
               { data: 'many_action', name: 'many_action'},
               { data: 'total_action', name: 'total_action'},
               { data: 'price_doctor', name: 'price_doctor'},
               { data: 'material_id', name: 'material_id'},
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

     function template(d) {

        console.log(d);

        return `

                <table class="table details-table" id="posts-${d.id}">
                    <thead>
                    <tr>
                        <th>Tindakan</th>
                        <th>Biaya</th>
                        <th>Banyak</th>
                        <th>Total</th>
                        <th>Biaya Dokter</th>
                        <th>Bahan/Obat</th>
                        <th>Biaya</th>
                        <th>Banyak</th>
                        <th>Total</th>
                    </tr>


            </table>

        `;
    }

    $('#btn-confirm').click(function(){
        var examination_inpatient_id = $(this).data('value');
        $('#form-delete-' + examination_inpatient_id).submit();
    });

});

function on_delete(examination_inpatient_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', examination_inpatient_id);
}

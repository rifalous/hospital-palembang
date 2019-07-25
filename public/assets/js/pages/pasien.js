var tPasien;
$(document).ready(function(){

	tPasien = $('#table-pasien').DataTable({
		ajax: SITE_URL + '/pasien/get_data',
        columns: [
            {
                "className":      'details-control',
                "orderable":      false,
                "searchable":     true,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'no_rm', name: 'no_rm'},
            { data: 'name', name: 'name'},
            { data: 'allergy', name: 'allergy'},
            { data: 'another_note', name: 'another_note'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        order: [1, 'asc'],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#table-pasien tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tPasien.row(tr);
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
              
               { data: 'place', name: 'place'},
               { data: 'date_of_birth', name: 'date_of_birth'},
               { data: 'gender', name: 'gender'},
               { data: 'religion', name: 'religion'},
               { data: 'education', name: 'education'},
               { data: 'age', name: 'age'},
               
            ],
            ordering: false,
            searching: false,
            paging: false,
            info: false
        });
    }

     function template(d) {

        console.log(d);

        return `

                <table class="table details-table" id="posts-${d.id}">
                    <thead>
                    <tr>
                        <th>Tempat</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Pendidikan</th>
                        <th>Usia</th>
                    </tr>


            </table>

        `;
    }

    $('#btn-confirm').click(function(){
        var pasien_id = $(this).data('value');
        $('#form-delete-' + pasien_id).submit();
    });

});

function on_delete(pasien_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', pasien_id);
}

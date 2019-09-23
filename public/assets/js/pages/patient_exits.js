var tbProgram;
$(document).ready(function(){
	tbProgram = $('#table-patient-exits').DataTable({
        // order: [2, 'asc'],
        ajax: SITE_URL + '/patient_exits/get_data',
        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
			{
                "className":      'details-control',
                "orderable":      false,
                "searchable":     true,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'no_registrasi', name: 'no_registrasi' },
            { data: 'pasien_name', name: 'pasien_name' },
            { data: 'pasien_age', name: 'pasien_age' },
            { data: 'pasien_gender', name: 'pasien_gender'},
            { data: 'tgl_masuk', name: 'tgl_masuk'},
            { data: 'time', name: 'time'},
            { data: 'room_name', name: 'room_name'},
            { data: 'room_class', name: 'room_class'},
            { data: 'disease', name: 'disease'},
            { data: 'tgl_keluar', name: 'tgl_keluar'},
            { data: 'time_keluar', name: 'time_keluar'},
            { data: 'way_out', name: 'way_out'},
            { data: 'exit_state', name: 'exit_state'},
			{ data: 'total_biaya', name: 'total_biaya'},
			{ data: 'option', name: 'option', searching: false, sorting: false, class: 'text-center' }
        ],
        	scrollCollapse: true,
				scrollX: '100%',
            drawCallback: function(){
                $('[data-toggle="tooltip"]').tooltip({
                    'container': 'body'
                });
            }
    });
	$('#search').keyup(function(event){
		    if(event.keyCode == 13){
		       on_search();
		    }
	});

	$('#modal-add-edit').on('hidden.bs.modal', function () {
		  on_clear();
		});

		$('#select-all').click(function(even){
			if(this.checked) {
				// Iterate each checkbox
				$('[name="rowcheck[]"]').each(function() {
				  this.checked = true;                        
				});
			} else {
				$('[name="rowcheck[]"]').each(function() {
				  this.checked = false;                        
				});
			}
  	});

	$('#btn-confirm').click(function(){
        var id = $(this).data('value');
        $('#form-delete-' + id).submit();
    });

	$('#table-patient-exits tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tbProgram.row(tr);
        var tableId = 'posts-' + row.data().id;
        var tableId1 = 'posts1-' + row.data().id;
        var tableId2 = 'posts2-' + row.data().id;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
            initTable1(tableId1, row.data());
            initTable2(tableId2, row.data());
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
               { data: 'cost_inpatient', name: 'cost_inpatient'},
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

    function initTable2(tableId2, data) {
        $('#' + tableId2).DataTable({
            /*processing: true,
            serverSide: true,*/
            ajax: data.details_url2,
            columns: [
              
               { data: 'lab.keterangan', name: 'lab.keterangan'},
               { data: 'hasil', name: 'hasil'},
               { data: 'biaya', name: 'biaya'},
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

        <table class="table details-table2" id="posts2-${d.id}">
                <thead>
                <tr>
                    <th>Laboratorium</th>
                    <th>Hasil</th>
                    <th>Biaya</th>
                    <th>Penanggung Jawab</th>
                    
                </tr>


        </table>

        `;
    }

});

// search

function on_search()
{
	var src = $('#search').val();
  	tbProgram.search(src).draw();
}

// clear search

function on_clear_search()
{
	$('#search').val('');
	on_search();
}

// clear

function on_clear()
{
	$('#search').val('');
	$('#form-add-edit').trigger('reset').validate().resetForm();
  	$('.form-group').removeClass('has-error');
  	$('.help-block').html('');

}

function on_delete(id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', id);
}

$.fn.dataTable.ext.errMode = 'throw';
var tbLabCheck;
$(document).ready(function(){
	tbLabCheck = $('#table-lab-checkup').DataTable({
		ajax: SITE_URL + '/lab_checkup/get_data',
		columns: [
			{
                "className":      'details-control',
                "orderable":      false,
                "searchable":     true,
                "data":           null,
                "defaultContent": ''
            },
			{ data: 'pasien_name', name: 'pasien_name'},
			// { data: 'lab_keterangan', name: 'lab_keterangan'},
			{ data: 'total_biaya', name: 'total_biaya'},
			{ data: 'tanggal_registrasi', name: 'tanggal_registrasi'},
			{ data: 'catatan', name: 'catatan'},
			{ data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
		],
		order: [1, 'asc'],
		drawCallback: function(){
			$('[data-toggle="tooltip"]').tooltip();
		}
	});
	$('[name="lab_test[]"]').on("select2:select", function(e) {
		var temp = parseInt($('[name="total_amount"]').val());
		var action = getDetail($(this).val());
		temp = temp + parseInt(action.harga);
		$('[name="total_amount"]').val(temp);
	});

	$('[name="lab_test[]"]').on("select2:unselect", function(e) {
		var data = getDetail(e.params.data.id);
		var temp = parseInt($('[name="total_amount"]').val());
		temp = temp - parseInt(data.harga);
		$('[name="total_amount"]').val(temp);
	});

	$('#btn-confirm').click(function(){
        var id = $(this).data('value');
        $('#form-delete-' + id).submit();
	});
	
	$('#table-lab-checkup tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tbLabCheck.row(tr);
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
               { data: 'lab.keterangan', name: 'lab.keterangan'},
               { data: 'lab.harga', name: 'lab.harga'},
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
            <th>Nama Laboratorium</th>
            <th>Harga</th> 
        </tr>


        </table>
        `;
    }
});

function getDetail(id) {
	var res = $.ajax({
		url: SITE_URL+'/lab_checkup/get-labo-id/'+id,
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}

function on_search()
{
	var src = $('#search').val();
    tbLabCheck.search(src).draw();
}

// clear search

function on_clear_search()
{
	$('#search').val('');
	on_search();
}

function getInpatient()
{
	var res = $.ajax({
		url: SITE_URL + '/lab_checkup/get_inpatient',
		type: 'get',
		dataType: 'json',
		async: false,
	});

	return res.responseJSON;
}

arr_Inpatient = getInpatient();
$('[name="inpatient_id"]').select2({
    data: arr_Inpatient
}).on('change', function(){
	var inpatient = getInpatientDetail($(this).val());
	$('[name="pasien_id"]').val(inpatient.pasien.name).change();
	$('[name="gender"]').val(inpatient.detail.gender);	
	$('[name="room_id"]').val(inpatient.room.id).change();
});

function getInpatientDetail(id) {
	var res = $.ajax({
		url: SITE_URL+'/lab_checkup/get-inpatient-id/'+id,
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}

function on_delete(id){
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', id);
}
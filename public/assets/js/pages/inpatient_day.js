var tbProgram;
$(document).ready(function(){
	tbProgram = $('#table-inpatient-day').DataTable({
        order: [2, 'asc'],
        ajax: {
			url: SITE_URL + '/inpatient_day/get_data',
            data: function(d){
                d.tgl_bayar = $('[name="tgl_bayar"]').val();
            },
		},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'pasien.no_rm', name: 'pasien.no_rm' },
            { data: 'pasien.name', name: 'pasien.name' },
            { data: 'tgl_bayar', name: 'tgl_bayar' },
            { data: 'total_biaya', name: 'total_biaya'},
            { data: 'sisa_tagihan', name: 'sisa_tagihan'},
            { data: 'sisa_pembayaran', name: 'sisa_pembayaran'},
            { data: 'payment', name: 'payment'},
        ],
        	searching: false,

    });

    

});

function on_filter()
{
    $('#table-inpatient-day').data("data",{tgl_bayar:$('#tanggal').val()});
    // Redraw data table, causes data to be reloaded
    $('#table-inpatient-day').DataTable().draw();
}
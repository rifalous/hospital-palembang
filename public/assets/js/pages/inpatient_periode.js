var tbProgram;
$(document).ready(function(){
	tbProgram = $('#table-inpatient-periode').DataTable({
        order: [2, 'asc'],
        ajax: {
			url: SITE_URL + '/inpatient_periode/get_data',
            data: function(d){
                d.start_date = $('[name="start_date"]').val();
                d.end_date = $('[name="end_date"]').val();
            },
		},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'inpatient.no_registrasi', name: 'inpatient.no_registrasi' },
            { data: 'pasien_id', name: 'pasien_id' },
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
    $('#table-inpatient-periode').data("data",{start_date:$('#tanggal').val(),end_date:$('#tanggal1').val()});
    // Redraw data table, causes data to be reloaded
    $('#table-inpatient-periode').DataTable().draw();
}
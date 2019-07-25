var tbProgram;
$(document).ready(function(){
	tbProgram = $('#table-pasien-exit-list').DataTable({
        order: [2, 'asc'],
        ajax: {
			url: SITE_URL + '/pasien_exit_list/get_data',
            data: function(d){
                d.start_date = $('[name="start_date"]').val();
                d.end_date = $('[name="end_date"]').val();
            },
		},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
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
            { data: 'total_biaya', name: 'total_biaya'}
        ],
        	searching: false,
            scrollCollapse: true,
                    scrollX: '100%',

    });

    

});

function on_filter()
{
    $('#table-pasien-exit-list').data("data",{start_date:$('#tanggal').val(),end_date:$('#tanggal1').val()});
    // Redraw data table, causes data to be reloaded
    $('#table-pasien-exit-list').DataTable().draw();
}
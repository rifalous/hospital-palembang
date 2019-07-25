var tPark, tUser;
$(document).ready(function(){

	arr_line_chart = get_chart('line');
	arr_donut_chart = get_chart('donut');
	get_park = getParkTotal();

	line = Morris.Line({
		element: 'parkir-total',
		data: arr_line_chart,
		xkey: 'y',
		ykeys: ['a', 'b', 'c'],
		labels: ['Mobil', 'Motor', 'Lainnya'],
		hideHover: true,
		parseTime:false
	});

	donut = Morris.Donut({
	  element: 'parkir-donut',
	  data: arr_donut_chart
	});


	tPark = $('#table-park').DataTable({
		ajax: {
			url: SITE_URL + '/dashboard/get_data_park',
			data: function(d) {
				d.date_from = $('[name="date_from"]').val();
				d.date_to = $('[name="date_to"]').val();
				d.type_id = $('[name="type_id"]').val();
				d.group_location_id = $('[name="group_location_id"]').val();
				d.name = $('[name="name"]').val();
			}
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'user.user_data.name', name: 'user.user_data.name'},
            { data: 'group_location.name', name: 'group_location.name'},
            { data: 'type.name', name: 'type.name'},
            { data: 'park_at', name: 'park_at'},
        ],
        /*ordering: false,
        info: false,
        paging: false,
*/        scrollX: true
	});


	tUser = $('#table-user').DataTable({

		ajax: {
			url: SITE_URL + '/dashboard/get_data_user',
			data: function(d) {
				d.status = $('[name="status"]').val();
				d.name = $('[name="user_name"]').val();
			}
		},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'user_data.name', name: 'user_data.name'},
            { data: 'status', name: 'status'},
            { data: 'options', name: 'options', ordering: false, searching: false },
        ],
        /*ordering: false,
        info: false,
        paging: false,*/
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        },
        scrollX: true

	});

	$('[name="date_from"]').change(function(){
		tPark.draw();
	});

	$('[name="date_to"]').change(function(){
		tPark.draw();
	});

	$('[name="type_id"]').change(function(){
		tPark.draw();
	});

	$('[name="group_location_id"]').change(function(){
		tPark.draw();
	});

	$('[name="status"]').change(function(){
		tUser.draw();
	});

	$('[name="user_name"]').keyup(function(e){
		if (e.keyCode == 13) {
			tUser.draw();
		}
	});

	$('[name="name"]').keyup(function(e){
		if (e.keyCode == 13) {
			tPark.draw();
		}
	});

	window.setInterval(function(){

		arr_line_chart = get_chart('line');
		arr_donut_chart = get_chart('donut');
		get_park = getParkTotal();

		$('#total-park').text('Rp. ' + get_park.total_park);
		$('#total-car-park').text('Rp. ' + get_park.car_park);
		$('#total-motorbike-park').text('Rp. ' + get_park.motorbike_park);
		$('#total-other-park').text('Rp. ' + get_park.other_park);

		tPark.draw();

		tUser.draw();

		line.setData(arr_line_chart);

		donut.setData(arr_donut_chart);

		// console.log('tes');

	}, 10000);

	$('[name="date_filter"]').change(function(){

		arr_line_chart = get_chart('line');
		arr_donut_chart = get_chart('donut');
		get_park = getParkTotal();

		$('#total-park').text('Rp. ' + get_park.total_park);
		$('#total-car-park').text('Rp. ' + get_park.car_park);
		$('#total-motorbike-park').text('Rp. ' + get_park.motorbike_park);
		$('#total-other-park').text('Rp. ' + get_park.other_park);

		tPark.draw();

		tUser.draw();

		line.setData(arr_line_chart);

		donut.setData(arr_donut_chart);

	});

});

function get_chart(type)
{
	var res = $.ajax({
        url: SITE_URL + '/dashboard/get_chart',
        type: 'get',
        data: {
            type: type,
            date_filter: $('[name="date_filter"]').val(),
        },
        dataType: 'json',
        async: false
    });

    return res.responseJSON;
}

function getParkTotal()
{
	var res = $.ajax({
        url: SITE_URL + '/dashboard',
        data:{
        	date_filter: $('[name="date_filter"]').val(),
        },
        type: 'get',
        dataType: 'json',
        async: false
    });

    return res.responseJSON;
}
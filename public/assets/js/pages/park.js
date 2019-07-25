var tPark;
$(document).ready(function(){

	tPark = $('#table-park').DataTable({
		ajax: {
            url:SITE_URL + '/parking_history',
            data: function(d) {
                d.from_date = $('[name="from_date"]').val();
                d.to_date = $('[name="to_date"]').val();
            }
        },
        columns: [
            { data: 'user.user_data.name', name: 'user.user_data.name'},
            { data: 'type.name', name: 'type.name'},
            { data: 'plate_registration_number', name: 'plate_registration_number'},
            { data: 'group_location.name', name: 'group_location.name'},
            { data: 'amount', name: 'amount', class: 'text-right', sorting: false },
            { data: 'real_amount', name: 'real_amount', class: 'text-right', sorting: false },
            { data: 'park_at', name: 'park_at'},
        ]
	});

    $('[name="from_date"]').change(function(){
        tPark.draw();
    });

    $('[name="to_date"]').change(function(){
        tPark.draw();
    });


});

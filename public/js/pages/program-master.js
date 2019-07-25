var tbProgram;
$(document).ready(function(){
	tbProgram = $('#table-program').DataTable({
		order: [2, 'asc'],
        ajax: SITE_URL + '/transaction/program/get_data',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'option', name: 'option', orderable: false, searchable: false, class: 'text-center' },
            {
              "className": 'details-control',
              "orderable": false,
              "searchable": false,
              "data": null,
              "defaultContent": ''
            },
            { data: 'code', name: 'code' },
            { data: 'name', name: 'name' },
            { data: 'vocation_name', name: 'vocation_name' },
            { data: 'sub_vocation_name', name: 'sub_vocation_name' },
            { data: 'is_hostel', name: 'hostel'},
            { data: 'sequence', name: 'sequence'},
            { data: 'is_active', name: 'active'}
        ],
  //       scrollCollapse: true,
		// scrollX: '100%',
    });


	$('#table-program tbody').on('click', 'td.details-control', function () {
	    var tr = $(this).closest('tr');
	    var row = tbProgram.row( tr );

	    if ( row.child.isShown() ) {
	        // This row is already open - close it
	        row.child.hide();
	        tr.removeClass('shown');
	    }
	    else {
	        // Open this row
	        row.child( format(row.data()) ).show();
	        tr.addClass('shown');
	    }
  	});

  	function format (d) {

  		var details = d.details;

  		the_data = '';

  		$.each(JSON.parse(details), function(i, v){
  			the_data += '<tr>';
  			the_data += '<td>' + v.competence + '</td>';
  			the_data += '<td>' + v.hour + ' JP </td>';
  			the_data += '<td>' + v.description + '</td>';
  			the_data += '</tr>';
  		});

  		the_data_result = the_data == '' ? '<tr><td colspan="4" class="text-center">Tidak ada data</td></tr>' : the_data;

  		render =   '<div class="row">'+
  						'<div class="col-md-6">' +
	  						'<h4>Lebih Lanjut</h4>' +
		  					'<table class="table">'+
		  						'<tr>'+
		  							'<th>Kualifikasi</th>'+
		  							'<th>:</th>'+
		  							'<td>'+ d.qualification +'</td>'+
								'</tr>'+
		  						'<tr>'+
		  							'<th>Total Paket</th>'+
		  							'<th>:</th>'+
		  							'<td>'+ d.number_of_packets +' Kompetensi</td>'+
								'</tr>'+
								'<tr>'+
		  							'<th>Durasi</th>'+
		  							'<th>:</th>'+
		  							'<td>'+ d.long_training +' JP</td>'+
								'</tr>'+
							'</table>'+
						'</div>'+
						
						'<div class="col-md-6">'+
							'<h4>Tujuan</h4>'+
		  					'<p>' + d.objective + '</p>'+
						'</div>'+
						// '<div class="col-md-12">' +
						// 	'<h4>Data Detail</h4>' +
						// 	'<hr>' +
						// '</div>' +
						
						'<div class="col-md-12">' +
							'<div class="card-box">'+
					          '<ul class="nav nav-tabs navtab-bg nav-justified">'+
					            '<li class="active">'+
					              '<a href="#participant" data-toggle="tab" aria-expanded="false">'+
					                '<span class="visible-xs"><i class="fa fa-home"></i></span>'+
					                '<span class="hidden-xs">Persyaratan Peserta</span>'+
					              '</a>'+
					            '</li>'+
					            '<li class="">'+
					              '<a href="#instructor" data-toggle="tab" aria-expanded="false">'+
					                '<span class="visible-xs"><i class="fa fa-home"></i></span>'+
					                '<span class="hidden-xs">Persyaratan Instruktur</span>'+
					              '</a>'+
					            '</li>'+
					            '<li class="">'+
					              '<a href="#detail" data-toggle="tab" aria-expanded="false">'+
					                '<span class="visible-xs"><i class="fa fa-home"></i></span>'+
					                '<span class="hidden-xs">Daftar Unit Kompetensi</span>'+
					              '</a>'+  
					            '</li>'+
					          '</ul>'+

					          	'<div class="tab-content">'+
						            '<div class="tab-pane active" id="participant">'+
						              	'<table class="table">'+
						              		'<tr>'+
						              			'<th>Pendidikan</th>'+
						              			'<th>:</th>'+
						              			'<td width="30%">' + d.education_participan + '</td>'+
						              			'<th>Jenis Kelamin</th>'+
						              			'<th>:</th>'+
						              			'<td width="30%">' + d.gender_participan + '</td>'+
						              		'</tr>'+
						              		'<tr>'+
						              			'<th>Pelatihan</th>'+
						              			'<th>:</th>'+
						              			'<td width="30%">' + d.training_participan + '</td>'+
						              			'<th>Umur</th>'+
						              			'<th>:</th>'+
						              			'<td width="30%">' + d.age_participan + '</td>'+
						              		'</tr>'+
						              		'<tr>'+
						              			'<th>Pengalaman Kerja</th>'+
						              			'<th>:</th>'+
						              			'<td width="30%">' + d.experience_participan + '</td>'+
						              			'<th>Kesehatan</th>'+
						              			'<th>:</th>'+
						              			'<td width="30%">' + d.healty_participan + '</td>'+
						              		'</tr>'+
						              		'<tr>'+
						              			'<th>Persyaratan Khusus</th>'+
						              			'<th>:</th>'+
						              			'<td colspan="4">' + d.spc_req_participan + '</td>'+
						              		'</tr>'+
						              	'</table>'+
						            '</div>'+

						            '<div class="tab-pane" id="instructor">'+
						              	'<table class="table">'+
						              		'<tr>'+
						              			'<th>Pendidikan Formal</th>'+
						              			'<th>:</th>'+
						              			'<td width="30%">' + d.education_instructor + '</td>'+
						              			'<th>Pengalaman Kerja</th>'+
						              			'<th>:</th>'+
						              			'<td width="30%">' + d.experience_instructor + '</td>'+
						              		'</tr>'+
						              		'<tr>'+
						              			'<th>Kompetensi Metodologi</th>'+
						              			'<th>:</th>'+
						              			'<td width="30%">' + d.metodology_competence + '</td>'+
						              			'<th>Kesehatan</th>'+
						              			'<th>:</th>'+
						              			'<td width="30%">' + d.healty_instructor + '</td>'+
						              		'</tr>'+
						              		'<tr>'+
						              			'<th>Kompetensi Teknis</th>'+
						              			'<th>:</th>'+
						              			'<td width="30%">' + d.special_competence + '</td>'+
						              			'<th>Persyaratan Khusus</th>'+
						              			'<th>:</th>'+
						              			'<td width="30%">' + d.spc_req_instructor + '</td>'+
						              		'</tr>'+
						              	'</table>'+
						            '</div>'+

						            '<div class="tab-pane" id="detail">'+
						              	'<table class="table table-colored table-inverse">' +
											'<thead>' +
												'<tr>' + 
													'<th> Unit Kompetensi </th> ' +
													'<th> Lamanya </th> ' +
													'<th> Deskripsi </th> ' +
												'</tr>' +
											'</thead>' +
											'<tbody>' + the_data_result + '</tbody>' +
										'</table>' +	
						            '</div>'+
					        	'</div>'+
							'</div>'+
						'</div>'+
						'<div class="clearfix"></div>' + 
					'</div>';

  		return render;
  	}

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

		var id = [];
		$('input[name="rowcheck[]"]:checked').each(function(){
			id.push($(this).val());
		});

		$.ajax({

			url: SITE_URL + '/transaction/program/destroy/',
			type: 'DELETE',
			data: {
				id: id
			},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			beforeSend: function(){
				$('#btn-confirm').attr('disabled', 'disabled');
				$('#btn-confirm').html('<i class="fa fa-spinner fa-pulse"></i> Loading ...');
			},
			success: function(data){
				show_notification(data.title, data.type, data.message);
				$('#modal-delete-confirm').modal('hide');
				on_search();
			},
			error: function(xhr, status, error) {
				show_notification('Error', 'error', error);
			},
			complete:function () { 
				$('#btn-confirm').html('Yes');
				$('#btn-confirm').removeAttr('disabled');
			}
		});

	});

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

// edit

function on_edit()
{
	if ($('input[name="rowcheck[]"]:checked').length == 0) {
      	show_notification('Informasi', 'warning', 'Silahkan Pilih Data Dahulu!');
  	}
  	else if ($('input[name="rowcheck[]"]:checked').length > 1) {
      	show_notification('Information', 'warning', 'Silahkan Pilih Salah Satu Data!');
  	}
  	else {

		var id = $('input[name="rowcheck[]"]:checked').val();
		window.location.replace(SITE_URL + '/transaction/program/'+id+'/edit');
  	}

}

// delete

function on_delete()
{

	if ($('input[name="rowcheck[]"]:checked').length == 0) {
	    show_notification('Informasi', 'warning', 'Silahkan Pilih Data Dahulu!');
	} else {
	    $('#modal-delete-confirm').modal('show');
	}

}
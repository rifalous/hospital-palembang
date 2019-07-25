$(document).ready(function(){

	$('#form-add-edit').validate({
		rules: {
        	email: {
            	remote: {
                    url: SITE_URL + '/user/validate',
                    type: 'post',
                    data: {
	                        email: function() { return $('input[name="email"]').val() },
	                        id: function() { return $('input[name="id"]').val() != undefined ? $('input[name="id"]').val() : '' },
                            _token : function() { return $('meta[name="csrf-token"]').attr('content') },
                            type: function() { return 'email' }
                      	}
                  	}
              	},
		    retype_password: {
		      equalTo: '[name="password"]'
		    }
		},
	    messages: {
	        email: {
	            remote: '{0} has been used'
	        },
	        retype_password: {
	        	equalTo: 'Password not match'
	        }
	    },

	    onkeyup: function(element){$(element).valid()},
	});

	$('[name="division_id"]').change(function(){
		var div_id = $(this).val();

		if (div_id === '') {
			$('[name="department_id"]').find('option').remove();
		} else {
			arr_dept = getDeptByDivId(div_id);
			$('[name="department_id"]').find('option').remove();
			$('[name="department_id"]').select2({
				data: arr_dept
			});
		}
		
	});

});

function getDeptByDivId(div_id)
{
	var res = $.ajax({
		url: SITE_URL + '/division/get_department_by_division/' + div_id,
		type: 'get',
		dataType: 'json',
		async: false
	});

	return res.responseJSON;
}
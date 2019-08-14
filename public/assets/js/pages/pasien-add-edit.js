$(document).ready(function(){
	$('#form-add-edit').validate();
});

$(function(){
	var father_name = '#father_name';
	var mother_name = '#mother_name';
	var guardian_name = '#guardian_name';
	var family_relationship ='#family_relationship'; 

	$(father_name).prop('required', true);
	$(mother_name).prop('required', true);
	$(guardian_name).prop('required', true);
	$(family_relationship).prop('required', true);

	$(guardian_name).change(function() {
        if($(guardian_name).val() != "") {
            $(father_name).prop('required', false);
            $(mother_name).prop('required', false);
			$(family_relationship).prop('required', true);
		}
        else if($(guardian_name).val() == "") {
            $(father_name).prop('required', true);
            $(mother_name).prop('required', true);
		}
	});

	$(father_name).change(function() {
        if($(father_name).val() != "") {
			$(guardian_name).prop('required', false);
			$(family_relationship).prop('required', false);
			$(mother_name).prop('required', false);
		}
        else if($(father_name).val() == "") {
			$(guardian_name).prop('required', true);
			$(family_relationship).prop('required', true);
			$(mother_name).prop('required', true);
		}
	});

});

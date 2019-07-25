$(document).ready(function(){

	$('.parent').click(function(){
		if ($(this).is(':checked')) {
			$('.children-'+$(this).data('value')).prop('checked', true);
		} else {
			$('.children-'+$(this).data('value')).prop('checked', false);
		}
	});

	$('.children').click(function(){
		$('.parent-'+$(this).data('value')).prop('checked', true);
	});

	$('#form-add-edit').validate();

});
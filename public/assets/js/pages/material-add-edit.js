$(document).ready(function(){
	$('#form-add-edit').validate();
});

function persen1() {

	var purchase_price 	     = parseInt(document.getElementById('purchase_price').value);
	var selling_price 	     = parseInt(document.getElementById('selling_price').value);

	var total_persen  = ((selling_price - purchase_price)/purchase_price)*100 ;

	document.getElementById('profit').value = total_persen;

	console.log('profit');
	persen2();
}

function persen2() {

	var purchase_price 	     = parseInt(document.getElementById('purchase_price').value);
	var recipe_prices 	     = parseInt(document.getElementById('recipe_prices').value);

	var total_persen  = ((recipe_prices - purchase_price)/purchase_price)*100 ;

	document.getElementById('profit_persen').value = total_persen;

	console.log('profit_persen');
}
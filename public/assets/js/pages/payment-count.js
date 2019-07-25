
// Update Pembayaran

$("#jumlah_dibayar").change(function(){
    var total_biaya = Number($("#total_biaya").val());
    var jumlah_dibayar = Number($(this).val());
    var hasil = parseFloat(total_biaya - jumlah_dibayar);
	$("#sisa_tagihan").val(hasil);
    $("#sisa_pembayaran").val(hasil);
});

$("#diskon").change(function(){
    var total_biaya = Number($("#total_biaya").val());
    var diskon = Number($(this).val());
    var jumlah_dibayar = Number($("#jumlah_dibayar").val());
    var hasil = parseFloat((total_biaya - (total_biaya * diskon / 100)) - jumlah_dibayar);
	$("#sisa_tagihan").val(hasil);
    $("#sisa_pembayaran").val(hasil);
});

function updatePrice(val)
{
	$("#jumlah_dibayar").val(val);
	$("#jumlah_dibayar").trigger('change');
	$("#diskon").val(val);
	$("#diskon").trigger('change');
}


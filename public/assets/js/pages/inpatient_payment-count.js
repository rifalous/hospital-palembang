
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

$("[name='no_registrasi']").change(function(){
    const value = $(this).val();
    var res = $.ajax({
        url: SITE_URL+'/inpatient_payment/get_data/'+value,
        type: 'get',
        dataType: 'json',
        async: false
    });

    const output = res.responseJSON;
    const pasien = output.pasien;
    const room = output.room;

    if (output != {}) {
        $('[name="pasien_rm_number"]').val(pasien.no_rm +' - ' + pasien.name)
        $('[name="pasien_id"]').val(pasien.id)

        $('[name="room_name"]').val(room.name +' - ' + room.level.class)
        $('[name="room_id"]').val(room.id)

        $('[name="total_biaya"]').val(output.examination_inpatient.amount);
        $('[name="address"]').val(output.address);
    }
});


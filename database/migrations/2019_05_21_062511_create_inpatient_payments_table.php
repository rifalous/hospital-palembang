<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInpatientPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inpatient_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('examination_inpatient_id');
            $table->integer('pasien_id');
            $table->integer('room_id');
            $table->integer('total_biaya');
            $table->integer('sisa_tagihan');
            $table->integer('jumlah_dibayar');
            $table->string('tgl_bayar');
            $table->integer('diskon');
            $table->string('discount');
            $table->integer('sisa_pembayaran');
            $table->string('payment');
            $table->string('address');
            $table->string('ket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inpatient_payments');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientExitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_exits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_registrasi');
            $table->integer('pasien_id');
            $table->string('kel');
            $table->string('age');
            $table->string('address');
            $table->string('tgl_masuk');
            $table->string('time');
            $table->integer('room_id');
            $table->string('disease');
            $table->string('tgl_keluar');
            $table->string('time_keluar');
            $table->string('way_out');
            $table->string('exit_state');
            $table->string('total_biaya');
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
        Schema::dropIfExists('patient_exits');
    }
}

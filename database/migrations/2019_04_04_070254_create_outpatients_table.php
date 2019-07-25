<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutpatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('outpatients');
        Schema::create('outpatients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_registrasi');
            $table->integer('pasien_id');
            $table->string('tgl_periksa');
            $table->string('poliklinik');
            $table->integer('doctor_id');
            $table->string('disease');
            $table->string('complaint');
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
        Schema::dropIfExists('outpatients');
    }
}

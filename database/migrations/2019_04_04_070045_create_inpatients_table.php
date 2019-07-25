<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInpatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inpatients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_registrasi');
            $table->integer('pasien_id');
            $table->string('tgl_masuk');
            $table->string('time');
            $table->string('entry_procedure');
            $table->integer('room_id');
            $table->integer('doctor_id');
            $table->string('disease');
            $table->string('person_in_charge');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
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
        Schema::dropIfExists('inpatients');
    }
}

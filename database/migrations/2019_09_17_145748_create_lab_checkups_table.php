<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabCheckupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_checkups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inpatient_id');
            $table->string('lab_test');
            $table->double('total_ammount', 25,2);
            $table->string('registration_date');
            $table->string('notes');
            $table->string('person_in_charge');
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
        Schema::dropIfExists('lab_checkups');
    }
}

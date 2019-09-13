<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExaminationInpatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('examination_inpatient');
        Schema::create('examination_inpatient', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inpatient_id');
            $table->string('room_id');
            $table->string('level_id');
            $table->double('amount_action', 25,2);
            $table->double('amount_material', 25,2);
            $table->double('amount', 25,2);
            $table->string('check_date');
            $table->string('registration_date');
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
        Schema::dropIfExists('examination_inpatient');
    }
}

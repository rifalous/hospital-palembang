<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationOutpatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('examination_outpatients');
        Schema::create('examination_outpatients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outpatient_id');
            $table->string('pasien_id');
            $table->string('doctor_name');
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
        Schema::dropIfExists('examination_outpatients');
    }
}

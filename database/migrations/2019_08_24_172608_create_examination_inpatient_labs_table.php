<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationInpatientLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_inpatient_labs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('examination_inpatient_id');
            $table->string('hasil');
            $table->double('biaya', 25,2);
            $table->string('doctor_id');
            $table->string('lab_id');
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
        Schema::dropIfExists('examination_inpatient_labs');
    }
}

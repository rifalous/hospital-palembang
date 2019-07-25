<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationOutpatientDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('examination_outpatient_datas');
        Schema::create('examination_outpatient_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('examination_outpatient_id');
            $table->integer('action_id');
            $table->double('cost_outpatient', 25,2);
            $table->integer('many_action');
            $table->double('total_action', 25,2);
            $table->string('doctor_id');
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
        Schema::dropIfExists('examination_outpatient_datas');
    }
}

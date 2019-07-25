<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationOutpatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('examination_outpatient_details');
        Schema::create('examination_outpatient_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('examination_outpatient_id');
            $table->integer('material_id');
            $table->double('price_material', 25,2);
            $table->integer('many_material');
            $table->double('total_material', 25,2);
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
        Schema::dropIfExists('examination_outpatient_details');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExaminationInpatientDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('examination_inpatient_details');
        Schema::create('examination_inpatient_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('examination_inpatient_id');
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
        Schema::dropIfExists('examination_inpatient_details');
    }
}

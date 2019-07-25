<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('actions');
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action');
            $table->integer('level_id');
            $table->integer('material');
            $table->integer('service_rs');
            $table->integer('service_medis');
            $table->integer('service_anestesi');
            $table->integer('service_dll');
            $table->integer('total');
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
        Schema::dropIfExists('actions');
    }
}

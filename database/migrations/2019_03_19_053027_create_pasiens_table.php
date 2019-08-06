<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pasiens');
        Schema::create('pasiens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_rm');
            $table->string('name');
            $table->string('allergy');
            $table->string('another_note');
            $table->string('no_bpjs');
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
        Schema::dropIfExists('pasiens');
    }
}

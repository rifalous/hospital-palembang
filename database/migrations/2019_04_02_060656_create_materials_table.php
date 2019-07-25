<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('materials');
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('packaging');
            $table->integer('fill_in');
            $table->string('unit');
            $table->integer('minimum_stock');
            $table->string('group');
            $table->string('type');
            $table->string('supplier_id');
            $table->double('purchase_price', 25,2)->default(0);
            $table->double('selling_price', 25,2)->default(0);
            $table->integer('recipe_prices')->default(0);
            $table->integer('profit')->default(0);
            $table->integer('profit_persen')->default(0);
            $table->string('expire_date');
            $table->string('last_update');
            $table->string('update_by');
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
        Schema::dropIfExists('materials');
    }
}

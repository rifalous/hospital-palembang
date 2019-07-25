<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasienDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pasien_datas');
        Schema::create('pasien_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pasien_id');
            $table->string('place');
            $table->string('date_of_birth');
            $table->string('gender');
            $table->string('religion');   
            $table->string('education');   
            $table->string('work');   
            $table->string('status');   
            $table->string('blood_group');   
            $table->string('address');  
            $table->string('district_id'); 
            $table->string('city_id'); 
            $table->string('province_id'); 
            $table->string('postal_code'); 
            $table->string('identification_number'); 
            $table->string('phone');   
            $table->string('father_name');   
            $table->string('mother_name');   
            $table->string('age');   
            $table->string('age_father');   
            $table->string('age_mother');   
            $table->string('guardian_name');   
            $table->string('guardian_address');   
            $table->string('family_relationship');   
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
        Schema::dropIfExists('pasien_datas');
    }
}

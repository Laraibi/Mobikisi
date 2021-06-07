<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('fullName',20);
            $table->boolean('sexe');
            $table->date('DateOfBirth');
            $table->integer('weight_kg');
            $table->integer('height_cm');
            $table->Enum('grpSanguin',array('O+','O-','A+','A-','B-','B+','AB+','AB-'));
            $table->string('Mutuelle',20);
            $table->string('photo_path');
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
        Schema::dropIfExists('patient');
    }
}

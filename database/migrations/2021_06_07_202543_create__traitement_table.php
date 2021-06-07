<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraitementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traitement', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->date('Date_Debut');
            $table->date('Date_Fin')->nullable();
            $table->string('Nom_Medicament');
            $table->integer('duree');
            $table->string('ordonnance_path');
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
        Schema::dropIfExists('traitement');
    }
}

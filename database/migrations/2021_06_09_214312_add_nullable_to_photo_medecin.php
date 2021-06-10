<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToPhotoMedecin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Medecin', function (Blueprint $table) {
            //
            $table->string('photo_path')->nullable()->change();
            // $table->addColumnDefinition('')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Medecin', function (Blueprint $table) {
            //
            $table->string('photo_path')->nullable(false)->change();
        });
    }
}

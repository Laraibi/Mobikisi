<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTableTraitementStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traitement', function (Blueprint $table) {
            //
            $table->dropColumn('Date_Fin');
            $table->string('ordonnance_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('traitement', function (Blueprint $table) {
            //;
            $table->date('Date_Fin')->nullable();
            $table->string('ordonnance_path')->change();
        });
    }
}

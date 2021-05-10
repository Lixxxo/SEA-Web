<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProfesorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profesor', function (Blueprint $table) {
            $table->foreign('asignatura_nrc', 'FKProfesor840451')->references('nrc')->on('asignatura')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profesor', function (Blueprint $table) {
            $table->dropForeign('FKProfesor840451');
        });
    }
}

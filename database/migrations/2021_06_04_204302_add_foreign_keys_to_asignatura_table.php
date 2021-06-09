<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAsignaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asignatura', function (Blueprint $table) {
            $table->foreign('Encargado_DocenteUsuariorut', 'FKAsignatura38468')->references('Usuariorut')->on('encargado_docente')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Encuestanombre', 'FKAsignatura59802')->references('nombre')->on('encuesta')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asignatura', function (Blueprint $table) {
            $table->dropForeign('FKAsignatura38468');
            $table->dropForeign('FKAsignatura59802');
        });
    }
}

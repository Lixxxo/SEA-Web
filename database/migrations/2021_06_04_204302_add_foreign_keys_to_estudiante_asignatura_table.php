<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEstudianteAsignaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estudiante_asignatura', function (Blueprint $table) {
            $table->foreign('EstudianteUsuariorut', 'FKEstudiante406078')->references('Usuariorut')->on('estudiante')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Asignaturanrc', 'FKEstudiante843963')->references('nrc')->on('asignatura')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estudiante_asignatura', function (Blueprint $table) {
            $table->dropForeign('FKEstudiante406078');
            $table->dropForeign('FKEstudiante843963');
        });
    }
}

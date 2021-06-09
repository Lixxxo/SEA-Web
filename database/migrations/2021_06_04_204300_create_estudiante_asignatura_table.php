<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudianteAsignaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiante_asignatura', function (Blueprint $table) {
            $table->string('Asignaturanrc');
            $table->string('EstudianteUsuariorut')->index('FKEstudiante406078');
            $table->primary(['Asignaturanrc', 'EstudianteUsuariorut']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiante_asignatura');
    }
}

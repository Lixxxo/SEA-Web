<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignatura', function (Blueprint $table) {
            $table->string('nrc')->primary();
            $table->string('codigo_asignatura');
            $table->string('nombre');
            $table->string('rut_profesor')->nullable();
            $table->string('nombre_profesor')->nullable();
            $table->string('Encuestanombre')->index('FKAsignatura59802');
            $table->string('Encargado_DocenteUsuariorut')->nullable()->index('FKAsignatura38468');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignatura');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodoAsignaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodo_asignatura', function (Blueprint $table) {
            $table->string('Periodocodigo_semestre');
            $table->string('Asignaturanrc')->index('FKPeriodo_As151024');
            $table->primary(['Periodocodigo_semestre', 'Asignaturanrc']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodo_asignatura');
    }
}

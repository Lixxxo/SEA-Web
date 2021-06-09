<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodo', function (Blueprint $table) {
            $table->string('codigo_semestre')->primary();
            $table->string('descripcion')->nullable();
            $table->string('Usuariorut')->index('FKPeriodo741776');
            $table->string('Encargado_DocenteUsuariorut')->nullable()->index('FKPeriodo843927');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodo');
    }
}

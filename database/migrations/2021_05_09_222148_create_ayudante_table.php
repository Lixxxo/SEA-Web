<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAyudanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayudante', function (Blueprint $table) {
            $table->string('rut_ayudante')->primary();
            $table->string('nombre_ayudante')->nullable();
            $table->string('asignatura_nrc')->index('FKAyudante118165');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ayudante');
    }
}

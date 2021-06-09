<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPeriodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periodo', function (Blueprint $table) {
            $table->foreign('Usuariorut', 'FKPeriodo741776')->references('rut')->on('usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Encargado_DocenteUsuariorut', 'FKPeriodo843927')->references('Usuariorut')->on('encargado_docente')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periodo', function (Blueprint $table) {
            $table->dropForeign('FKPeriodo741776');
            $table->dropForeign('FKPeriodo843927');
        });
    }
}

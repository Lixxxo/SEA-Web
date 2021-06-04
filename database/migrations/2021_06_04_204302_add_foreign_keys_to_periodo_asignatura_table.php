<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPeriodoAsignaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periodo_asignatura', function (Blueprint $table) {
            $table->foreign('Asignaturanrc', 'FKPeriodo_As151024')->references('nrc')->on('asignatura')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Periodocodigo_semestre', 'FKPeriodo_As617251')->references('codigo_semestre')->on('periodo')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periodo_asignatura', function (Blueprint $table) {
            $table->dropForeign('FKPeriodo_As151024');
            $table->dropForeign('FKPeriodo_As617251');
        });
    }
}

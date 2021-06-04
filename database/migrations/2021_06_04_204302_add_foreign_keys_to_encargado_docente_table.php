<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEncargadoDocenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('encargado_docente', function (Blueprint $table) {
            $table->foreign('Usuariorut', 'FKEncargado_120584')->references('rut')->on('usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('encargado_docente', function (Blueprint $table) {
            $table->dropForeign('FKEncargado_120584');
        });
    }
}

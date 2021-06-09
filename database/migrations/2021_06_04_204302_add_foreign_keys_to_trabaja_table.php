<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTrabajaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trabaja', function (Blueprint $table) {
            $table->foreign('Asignaturanrc', 'FKTrabaja115733')->references('nrc')->on('asignatura')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('AyudanteUsuariorut', 'FKTrabaja701161')->references('Usuariorut')->on('ayudante')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trabaja', function (Blueprint $table) {
            $table->dropForeign('FKTrabaja115733');
            $table->dropForeign('FKTrabaja701161');
        });
    }
}

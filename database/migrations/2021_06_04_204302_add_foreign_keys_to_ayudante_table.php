<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAyudanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ayudante', function (Blueprint $table) {
            $table->foreign('Usuariorut', 'FKAyudante376330')->references('rut')->on('usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ayudante', function (Blueprint $table) {
            $table->dropForeign('FKAyudante376330');
        });
    }
}

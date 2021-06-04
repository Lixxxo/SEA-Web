<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsuarioRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario_rol', function (Blueprint $table) {
            $table->foreign('Usuariorut', 'FKUsuario_Ro121759')->references('rut')->on('usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Rolrol', 'FKUsuario_Ro193094')->references('rol')->on('rol')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_rol', function (Blueprint $table) {
            $table->dropForeign('FKUsuario_Ro121759');
            $table->dropForeign('FKUsuario_Ro193094');
        });
    }
}

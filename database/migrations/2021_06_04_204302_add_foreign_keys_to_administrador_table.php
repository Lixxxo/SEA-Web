<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAdministradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administrador', function (Blueprint $table) {
            $table->foreign('Usuariorut', 'FKAdministra31262')->references('rut')->on('usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('administrador', function (Blueprint $table) {
            $table->dropForeign('FKAdministra31262');
        });
    }
}

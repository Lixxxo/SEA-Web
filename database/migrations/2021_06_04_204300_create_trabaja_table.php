<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabaja', function (Blueprint $table) {
            $table->string('Asignaturanrc');
            $table->string('AyudanteUsuariorut')->index('FKTrabaja701161');
            $table->primary(['Asignaturanrc', 'AyudanteUsuariorut']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabaja');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->string('rut')->primary();
            $table->string('nombre_completo')->nullable();
            $table->string('correo_electronico')->nullable();
            $table->string('clave')->nullable();
            $table->string('estado')->nullable();
            $table->string('AdministratorProfilerut')->nullable()->index('FKProfile652433');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}

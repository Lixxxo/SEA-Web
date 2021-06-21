<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->string('rut')->primary();
            $table->string('nombre_completo')->nullable();
            $table->string('correo_electronico')->nullable();
            $table->string('clave')->nullable();
            $table->integer('estado')->nullable();
            $table->string('AdministratorsProfilesrut')->index('FKProfiles810188');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}

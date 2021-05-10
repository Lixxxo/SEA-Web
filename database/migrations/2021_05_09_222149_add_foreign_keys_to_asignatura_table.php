<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAsignaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asignatura', function (Blueprint $table) {
            $table->foreign('codigo_semestre', 'FKAsignatura120791')->references('codigo_semestre')->on('semestre')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asignatura', function (Blueprint $table) {
            $table->dropForeign('FKAsignatura120791');
        });
    }
}

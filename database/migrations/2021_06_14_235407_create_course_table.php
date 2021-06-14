<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->string('nrc')->primary();
            $table->string('codigo_asignatura');
            $table->string('rut_profesor')->nullable();
            $table->string('nombre_profesor')->nullable();
            $table->string('Teacher_ManagerProfilerut')->index('FKCourse734211');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course');
    }
}

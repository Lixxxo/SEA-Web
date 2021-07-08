<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nrc')->unique('nrc');
            $table->string('codigo_asignatura')->unique('codigo_asignatura');
            $table->string('rut_profesor')->nullable();
            $table->string('nombre_profesor')->nullable();
            $table->integer('Surveysid')->nullable()->index('FKCourses362920');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}

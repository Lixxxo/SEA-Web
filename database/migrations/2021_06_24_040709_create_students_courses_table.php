<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_courses', function (Blueprint $table) {
            $table->string('Usersrut');
            $table->integer('Coursesid')->index('FKStudents_C394876');
            $table->primary(['Usersrut', 'Coursesid']);
            $table->tinyInteger('isAnswered')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_courses');
    }
}

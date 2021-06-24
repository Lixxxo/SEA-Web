<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentsCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students_courses', function (Blueprint $table) {
            $table->foreign('Coursesid', 'FKStudents_C394876')->references('id')->on('courses')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Usersrut', 'FKStudents_C769011')->references('rut')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students_courses', function (Blueprint $table) {
            $table->dropForeign('FKStudents_C394876');
            $table->dropForeign('FKStudents_C769011');
        });
    }
}

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
            $table->foreign('StudentsProfilesrut', 'FKStudents_C82133')->references('Profilesrut')->on('students')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Coursesnrc', 'FKStudents_C909963')->references('nrc')->on('courses')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
            $table->dropForeign('FKStudents_C82133');
            $table->dropForeign('FKStudents_C909963');
        });
    }
}

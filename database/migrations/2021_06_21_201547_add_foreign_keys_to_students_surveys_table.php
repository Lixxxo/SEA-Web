<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentsSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students_surveys', function (Blueprint $table) {
            $table->foreign('StudentsProfilesrut', 'FKStudents_S187032')->references('Profilesrut')->on('students')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Surveysnombre', 'FKStudents_S269952')->references('nombre')->on('surveys')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students_surveys', function (Blueprint $table) {
            $table->dropForeign('FKStudents_S187032');
            $table->dropForeign('FKStudents_S269952');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_surveys', function (Blueprint $table) {
            $table->string('Surveysnombre');
            $table->string('StudentsProfilesrut')->index('FKStudents_S187032');
            $table->primary(['Surveysnombre', 'StudentsProfilesrut']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_surveys');
    }
}

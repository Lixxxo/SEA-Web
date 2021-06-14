<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_student', function (Blueprint $table) {
            $table->string('Surveynombre');
            $table->string('StudentProfilerut')->index('FKSurvey_Stu990882');
            $table->primary(['Surveynombre', 'StudentProfilerut']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_student');
    }
}

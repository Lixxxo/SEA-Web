<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSurveyStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('survey_student', function (Blueprint $table) {
            $table->foreign('Surveynombre', 'FKSurvey_Stu647784')->references('nombre')->on('survey')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('StudentProfilerut', 'FKSurvey_Stu990882')->references('Profilerut')->on('student')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey_student', function (Blueprint $table) {
            $table->dropForeign('FKSurvey_Stu647784');
            $table->dropForeign('FKSurvey_Stu990882');
        });
    }
}

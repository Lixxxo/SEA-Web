<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_course', function (Blueprint $table) {
            $table->foreign('Coursenrc', 'FKStudent_Co372805')->references('nrc')->on('course')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('StudentProfilerut', 'FKStudent_Co728520')->references('Profilerut')->on('student')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_course', function (Blueprint $table) {
            $table->dropForeign('FKStudent_Co372805');
            $table->dropForeign('FKStudent_Co728520');
        });
    }
}

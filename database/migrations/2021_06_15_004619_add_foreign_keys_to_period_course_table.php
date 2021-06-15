<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPeriodCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('period_course', function (Blueprint $table) {
            $table->foreign('Periodcodigo_semestre', 'FKPeriod_Cou122518')->references('codigo_semestre')->on('period')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Coursenrc', 'FKPeriod_Cou322953')->references('nrc')->on('course')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('period_course', function (Blueprint $table) {
            $table->dropForeign('FKPeriod_Cou122518');
            $table->dropForeign('FKPeriod_Cou322953');
        });
    }
}

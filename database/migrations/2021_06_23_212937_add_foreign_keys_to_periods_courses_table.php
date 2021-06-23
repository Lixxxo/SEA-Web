<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPeriodsCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periods_courses', function (Blueprint $table) {
            $table->foreign('Periodscodigo_semestre', 'FKPeriods_Co198481')->references('codigo_semestre')->on('periods')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Coursesnrc', 'FKPeriods_Co761431')->references('nrc')->on('courses')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periods_courses', function (Blueprint $table) {
            $table->dropForeign('FKPeriods_Co198481');
            $table->dropForeign('FKPeriods_Co761431');
        });
    }
}

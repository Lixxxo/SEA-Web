<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodsCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods_courses', function (Blueprint $table) {
            $table->string('Periodscodigo_semestre');
            $table->string('Coursesnrc')->index('FKPeriods_Co761431');
            $table->primary(['Periodscodigo_semestre', 'Coursesnrc']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periods_courses');
    }
}

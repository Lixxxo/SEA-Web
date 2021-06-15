<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('period_course', function (Blueprint $table) {
            $table->string('Periodcodigo_semestre');
            $table->string('Coursenrc')->index('FKPeriod_Cou322953');
            $table->primary(['Periodcodigo_semestre', 'Coursenrc']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('period_course');
    }
}

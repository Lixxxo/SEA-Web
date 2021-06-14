<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('period', function (Blueprint $table) {
            $table->foreign('Teacher_ManagerProfilerut', 'FKPeriod580180')->references('Profilerut')->on('teacher_manager')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('period', function (Blueprint $table) {
            $table->dropForeign('FKPeriod580180');
        });
    }
}

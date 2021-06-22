<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periods', function (Blueprint $table) {
            $table->foreign('Teacher_ManagersProfilesrut', 'FKPeriods440995')->references('Profilesrut')->on('teacher_managers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periods', function (Blueprint $table) {
            $table->dropForeign('FKPeriods440995');
        });
    }
}

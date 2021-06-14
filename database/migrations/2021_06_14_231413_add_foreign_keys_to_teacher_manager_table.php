<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTeacherManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_manager', function (Blueprint $table) {
            $table->foreign('Profilerut', 'FKTeacher_Ma93646')->references('rut')->on('profile')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_manager', function (Blueprint $table) {
            $table->dropForeign('FKTeacher_Ma93646');
        });
    }
}

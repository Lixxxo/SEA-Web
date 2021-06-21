<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTeacherManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_managers', function (Blueprint $table) {
            $table->foreign('Profilesrut', 'FKTeacher_Ma957535')->references('rut')->on('profiles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_managers', function (Blueprint $table) {
            $table->dropForeign('FKTeacher_Ma957535');
        });
    }
}

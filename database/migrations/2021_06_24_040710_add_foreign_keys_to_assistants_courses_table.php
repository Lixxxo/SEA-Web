<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssistantsCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assistants_courses', function (Blueprint $table) {
            $table->foreign('Usersrut', 'FKAssistants721060')->references('rut')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Coursesid', 'FKAssistants95196')->references('id')->on('courses')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assistants_courses', function (Blueprint $table) {
            $table->dropForeign('FKAssistants721060');
            $table->dropForeign('FKAssistants95196');
        });
    }
}

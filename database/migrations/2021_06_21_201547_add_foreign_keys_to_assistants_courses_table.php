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
            $table->foreign('Coursesnrc', 'FKAssistants580108')->references('nrc')->on('courses')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('AssistantsProfilesrut', 'FKAssistants61624')->references('Profilesrut')->on('assistants')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
            $table->dropForeign('FKAssistants580108');
            $table->dropForeign('FKAssistants61624');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssistantCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assistant_course', function (Blueprint $table) {
            $table->foreign('Coursenrc', 'FKAssistant_659942')->references('nrc')->on('course')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('AssistantProfilerut', 'FKAssistant_856010')->references('Profilerut')->on('assistant')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assistant_course', function (Blueprint $table) {
            $table->dropForeign('FKAssistant_659942');
            $table->dropForeign('FKAssistant_856010');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistantCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistant_course', function (Blueprint $table) {
            $table->string('AssistantProfilerut');
            $table->string('Coursenrc')->index('FKAssistant_659942');
            $table->primary(['AssistantProfilerut', 'Coursenrc']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assistant_course');
    }
}

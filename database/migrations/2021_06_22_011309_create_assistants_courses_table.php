<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistantsCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistants_courses', function (Blueprint $table) {
            $table->string('Profilesrut');
            $table->string('Coursesnrc')->index('FKAssistants580108');
            $table->primary(['Profilesrut', 'Coursesnrc']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assistants_courses');
    }
}

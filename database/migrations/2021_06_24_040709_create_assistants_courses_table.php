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
            $table->string('Usersrut');
            $table->integer('Coursesid')->index('FKAssistants95196');
            $table->primary(['Usersrut', 'Coursesid']);
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

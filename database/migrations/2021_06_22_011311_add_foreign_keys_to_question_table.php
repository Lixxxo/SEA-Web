<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question', function (Blueprint $table) {
            $table->foreign('Surveysnombre', 'FKQuestion271105')->references('nombre')->on('surveys')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question', function (Blueprint $table) {
            $table->dropForeign('FKQuestion271105');
        });
    }
}

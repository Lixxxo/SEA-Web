<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre')->unique();
            $table->tinyInteger('estado')->default(1);
            $table->tinyInteger('totalRespuestas')->default(0);
            $table->string('Coursesnrc')->index('FKSurveys93583');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveys');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssistantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assistant', function (Blueprint $table) {
            $table->foreign('Profilerut', 'FKAssistant18537')->references('rut')->on('profile')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assistant', function (Blueprint $table) {
            $table->dropForeign('FKAssistant18537');
        });
    }
}

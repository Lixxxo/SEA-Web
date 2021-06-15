<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProfileRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_role', function (Blueprint $table) {
            $table->foreign('Rolerol', 'FKProfile_Ro461810')->references('rol')->on('role')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Profilerut', 'FKProfile_Ro572743')->references('rut')->on('profile')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_role', function (Blueprint $table) {
            $table->dropForeign('FKProfile_Ro461810');
            $table->dropForeign('FKProfile_Ro572743');
        });
    }
}

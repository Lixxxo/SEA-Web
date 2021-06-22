<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProfilesRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles_roles', function (Blueprint $table) {
            $table->foreign('Profilesrut', 'FKProfiles_R167706')->references('rut')->on('profiles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('Rolesrol', 'FKProfiles_R914436')->references('rol')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles_roles', function (Blueprint $table) {
            $table->dropForeign('FKProfiles_R167706');
            $table->dropForeign('FKProfiles_R914436');
        });
    }
}

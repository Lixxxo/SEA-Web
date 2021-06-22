<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles_roles', function (Blueprint $table) {
            $table->string('Profilesrut');
            $table->string('Rolesrol')->index('FKProfiles_R914436');
            $table->primary(['Profilesrut', 'Rolesrol']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles_roles');
    }
}

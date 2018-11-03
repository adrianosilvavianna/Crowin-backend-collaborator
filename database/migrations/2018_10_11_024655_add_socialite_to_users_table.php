<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialiteToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('service')->nullable()->comment('email da rede social');
            $table->string('driver')->nullable()->comment('nome da rede social');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIfExists('facebook');
            $table->dropIfExists('google');
            $table->dropIfExists('github');
            $table->dropIfExists('profile_id');
        });
    }
}

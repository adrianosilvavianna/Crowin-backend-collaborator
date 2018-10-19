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
            $table->string('facebook')->nullable()->comment('email do facebook');
            $table->string('google')->nullable()->comment('email do google');
            $table->string('github')->nullable()->comment('email do google');
            $table->string('twitter')->nullable()->comment('email do twitter');
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

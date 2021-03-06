<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('age')->nullable()->comment('idade');
            $table->boolean('gender')->nullable()->comment('genero boleano, 0 - Homem, 1 - Mulher');
            $table->string('phone')->nullable()->comment('telefone pra contato');
            $table->longText('photo_address')->nullable()->comment('endereço de foto');
            $table->longText('about')->nullable()->comment('um pouco sobre o usuario');
            $table->string('cpf')->nullable()->comment('cpf do usuário');
            $table->string('facebook_link')->nullable()->comment('Link Facebook');
            $table->string('twitter_link')->nullable()->comment('Link Twitter');
            $table->string('nick_name')->nullable()->comment('apelido rede social');

            $table->unsignedInteger('user_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}

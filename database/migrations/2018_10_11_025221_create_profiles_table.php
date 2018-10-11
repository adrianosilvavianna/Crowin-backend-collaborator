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
            $table->integer('phone')->nullable()->comment('telefone pra contato');
            $table->longText('photo_address')->nullable()->comment('endereço de foto');
            $table->longText('about')->nullable()->comment('um pouco sobre o usuario');
            $table->string('cpf')->comment('cpf do usuário');

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

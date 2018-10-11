<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address')->complement('endereço');
            $table->string('number')->nullable()->complement('numero');
            $table->string('city')->nullable()->complement('cidade');
            $table->string('zip_code')->complement('cep');
            $table->string('district')->nullable()->complement('bairro');
            $table->longText('complement')->nullable()->complement('complemento');

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
        Schema::dropIfExists('locations');
    }
}

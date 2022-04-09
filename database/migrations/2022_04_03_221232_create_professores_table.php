<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professores', function (Blueprint $table) {
            $table->id();
            $table->boolean('administrador');
            $table->string('nome_oficial', 100);
            $table->string('nome_social', 100);
            $table->string('data_nascimento',30);
            $table->integer('genero');
            $table->string('cpf');
            $table->string('cep');
            $table->integer('graduacao');
            $table->boolean('disponibilidade');
            $table->string('email', 100);
            $table->string('telefone', 15);
            $table->boolean('wpp');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professores');
    }
}

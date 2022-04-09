<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turma', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('professor_id');
            $table->unsignedBigInteger('disciplina_id');
            $table->string('data_inicio',30);
            $table->string('data_final',30);
            $table->string('hora_inicio',30);
            $table->string('hora_final',30);
            $table->integer('vagas');
            $table->boolean('horario_ativo');
            $table->timestamps();

            //foreign key (constraints)
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('professor_id')->references('id')->on('professores');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turmas');
    }
}

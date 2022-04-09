<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelLegends\PtBrValidator\Rules\Cpf;

class Aluno extends Model
{
    use HasFactory;
    protected $fillable = [ 'nome_oficial', 'nome_social', 'data_nascimento', 'genero', 'cpf', 'cep', 'cor', 'descricao'];

    public function rules() {
        return [
            'nome_oficial' => 'required',
            'nome_social' => 'required',
            'data_nascimento' => 'required',
            'genero' => 'required',
            'cpf' => ['required', new Cpf],
            'cep' => 'required',
            'cor' => 'required',
            'descricao' => 'required',
        ];
    }
    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório',
        ];
    }

    public function tuma(){
        return $this->belongsTo('App\Models\Turma');
    }

}

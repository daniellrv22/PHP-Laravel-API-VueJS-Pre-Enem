<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelLegends\PtBrValidator\Rules\Cpf;

class Professor extends Model
{
    use HasFactory;
    protected $table = 'professores';
    protected $fillable = [ 'administrador', 'nome_oficial', 'nome_social', 'data_nascimento', 'genero', 'cpf', 'cep', 'graduacao', 'disponibilidade', 'email', 'telefone', 'wpp'];

    public function rules() {
        return [
            
            'administrador' => 'required|boolean',
            'nome_oficial' => 'required|unique:professores,nome_oficial,'.$this->id.'|min:3',
            'nome_social' => 'required',
            'data_nascimento' => 'required',
            'genero' => 'required',
            'cpf' => ['required', new Cpf],
            'cep' => 'required',
            'graduacao' => 'required',
            'disponibilidade' => 'required',
            'email' => 'required',
            'telefone' => 'required',
            'wpp' => 'required|boolean'//true, false, 1, 0, "1", "0"
        ];
    }
    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome_oficial.min' => 'O nome deve ter no mínimo 3 caracteres',
            'boolean' => 'O campo :attribute é um campo boolean',
            
        ];
    }
    public function disciplinas(){
        // um professor possui muitas disciplinas
        return $this->hasMany('App\Models\Disciplina');
    }
    
    public function tuma(){
        return $this->belongsTo('App\Models\Turma');
    }

}

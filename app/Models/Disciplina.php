<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;
    protected $fillable = ['professor_id','nome'];

    public function rules() {
        return [
            'professor_id' => 'exists:professores,id',
            'nome' => 'required|unique:disciplinas,nome,'.$this->id.'|min:3',
        ];
    }
     /*
            1) tabela
            2) nome da coluna que será pesquisada na tabela3
            3) id do registro que será desconsiderado na pesquisa
        */

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O nome da disciplina já existe',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres'
        ];
    }

    public function professor(){
        return $this->belongsTo('App\Models\Professor');
    }

    public function turma(){
        return $this->belongsTo('App\Models\Turma');
    }


}

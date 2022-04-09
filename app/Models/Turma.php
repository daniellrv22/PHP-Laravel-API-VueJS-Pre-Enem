<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;
    protected $table = 'turma';
    protected $fillable = ['aluno_id', 'professor_id', 'disciplina_id','data_inicio','data_final','hora_inicio','hora_final','vagas','horario_ativo'];

    public function rules() {
        return [
            'aluno_id' => 'exists:alunos,id',
            'professor_id' => 'exists:professores,id',
            'disciplina_id' => 'exists:disciplinas,id',
            'data_inicio' => 'required',
            'data_final' => 'required',
            'hora_inicio' => 'required',
            'hora_final' => 'required',
            'vagas' => 'required',
            'horario_ativo' => 'required'
        ];
    }
    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório'
        ];
    }
    public function alunos(){
        
        return $this->hasMany('App\Models\Aluno');
    }
    public function professores(){
        
        return $this->hasMany('App\Models\Professor');
    }

    public function disciplinas(){
        
        return $this->hasMany('App\Models\Disciplina');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use App\Repositories\ProfessorRepository;


class ProfessorController extends Controller
{
    public function __construct(Professor $professor) {
        $this->professor = $professor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $professorRepository = new ProfessorRepository($this->professor);

        if($request->has('atributos_disciplinas')) {
            $atributos_disciplinas = 'disciplinas:id,'.$request->atributos_disciplinas;
            $professorRepository->selectAtributosRegistrosRelacionados($atributos_disciplinas);
        }else{
            $professorRepository->selectAtributosRegistrosRelacionados('disciplinas');
        }

        if($request->has('filtro')) {
            $professorRepository->filtro($request->filtro);
        }

        if($request->has('atributos')) {
            $professorRepository->selectAtributos($request->atributos);
        }

        //$this->disciplina->with('professor')->get()
        return response()->json($professorRepository->getResultado(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //verificação das regras que estao no Model
       $request->validate($this->professor->rules(),$this->professor->feedback());

       $professor = $this->professor->create([
        'administrador' => $request->administrador,
        'nome_oficial' => $request->nome_oficial,
        'nome_social' => $request->nome_social,
        'data_nascimento' => $request->data_nascimento,
        'genero' => $request->genero,
        'cpf' => $request->cpf,
        'cep' => $request->cep,
        'graduacao' => $request->graduacao,
        'disponibilidade' => $request->disponibilidade,
        'email' => $request->email,
        'telefone' => $request->telefone,
        'wpp' => $request->wpp
       ]);
       return response()->json($professor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professor = $this->professor->with('disciplinas')->find($id);
        if($professor === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404) ;
        } 

        return response()->json($professor, 200);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $professor = $this->professor->find($id);

        if($professor === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($professor->rules() as $input => $regra) {
                
                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            
            $request->validate($regrasDinamicas, $professor->feedback());

        } else {
            $request->validate($professor->rules(), $professor->feedback());
        }
        
       //preencher o objeto $professor com os dados do request
        $professor->fill($request->all());
        //dd($professor->getAttributes());
        $professor->save();
        return response()->json($professor, 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professor = $this->professor->find($id);
        if($professor === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }
        $professor->delete();
        return response()->json(['msg' => 'O professor foi removida com sucesso!'], 200);
    }
}

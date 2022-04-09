<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use App\Repositories\AlunoRepository;

class AlunoController extends Controller
{
    public function __construct(Aluno $aluno) {
        $this->aluno = $aluno;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $alunoRepository = new AlunoRepository($this->aluno);

        if($request->has('filtro')) {
            $alunoRepository->filtro($request->filtro);
        }

        if($request->has('atributos')) {
            $alunoRepository->selectAtributos($request->atributos);
        } 

        return response()->json($alunoRepository->getResultado(), 200);
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
        $request->validate($this->aluno->rules());

        $aluno = $this->aluno->create([
            'nome_oficial' => $request->nome_oficial,
            'nome_social' => $request->nome_social,
            'data_nascimento' => $request->data_nascimento,
            'genero' => $request->genero,
            'cpf' => $request->cpf,
            'cep' => $request->cep,
            'cor' => $request->cor,
            'descricao' => $request->descricao
        ]);

        return response()->json($aluno, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aluno = $this->aluno->find($id);
        if($aluno === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404) ;
        } 

        return response()->json($aluno, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $aluno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aluno = $this->aluno->find($id);

        if($aluno === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($aluno->rules() as $input => $regra) {
                
                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            
            $request->validate($regrasDinamicas);

        } else {
            $request->validate($aluno->rules());
        }
        
        $aluno->fill($request->all());
        $aluno->save();
        
        return response()->json($aluno, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aluno = $this->aluno->find($id);

        if($aluno === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $aluno->delete();
        return response()->json(['msg' => 'O aluno foi removido com sucesso!'], 200);
    }

}

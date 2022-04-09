<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;
use App\Repositories\TurmaRepository;


class TurmaController extends Controller
{
    public function __construct(Turma $turma) {
        $this->turma = $turma;
    }
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $turmaRepository = new TurmaRepository($this->turma);


        if($request->has('filtro')) {
            $turmaRepository->filtro($request->filtro);
        }

        if($request->has('atributos')) {
            $turmaRepository->selectAtributos($request->atributos);
        } 

        return response()->json($turmaRepository->getResultado(), 200);
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
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->turma->rules(),$this->turma->feedback());

        $turma = $this->turma->create($request->all());
        return response()->json($turma, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $turma = $this->turma->find($id);
        if($turma === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404) ;
        } 

        return response()->json($turma, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function edit(Turma $turma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $turma = $this->turma->find($id);
        if($turma === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($turma->rules() as $input => $regra) {
                
                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            
            $request->validate($regrasDinamicas);

        } else {
            $request->validate($turma->rules());
        }
        
        $turma->fill($request->all());
        $turma->save();
        
        return response()->json($turma, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turma $turma)
    {
        $turma = $this->turma->find($id);

        if($turma === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $turma->delete();
        return response()->json(['msg' => 'O turma foi removido com sucesso!'], 200);
    }
}

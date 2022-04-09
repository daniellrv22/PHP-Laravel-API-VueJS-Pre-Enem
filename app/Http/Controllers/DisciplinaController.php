<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;
use App\Repositories\DisciplinaRepository;

class DisciplinaController extends Controller
{
    public function __construct(Disciplina $disciplina) {
        $this->disciplina = $disciplina;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $disciplinaRepository = new DisciplinaRepository($this->disciplina);
        
        if($request->has('atributos_professor')) {
            $atributos_professor ='professor:id,'.$request->atributos_professor;
            $disciplinaRepository->selectAtributosRegistrosRelacionados($atributos_professor);
        }else{

            $disciplinaRepository->selectAtributosRegistrosRelacionados('professor');
        }

        if($request->has('filtro')) {
            $disciplinaRepository->filtro($request->filtro);
        }

        if($request->has('atributos')) {
            $disciplinaRepository->selectAtributos($request->atributos);
        }

        return response()->json($disciplinaRepository->getResultado(), 200);
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
        $request->validate($this->disciplina->rules(),$this->disciplina->feedback());

        $disciplina = $this->disciplina->create($request->all());
        return response()->json($disciplina, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disciplina = $this->disciplina->with('professor')->find($id);
        if($disciplina === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404) ;
        } 

        return response()->json($disciplina, 200);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function edit(Disciplina $disciplina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $disciplina = $this->disciplina->find($id);

        if($disciplina === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($disciplina->rules() as $input => $regra) {
                
                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            
            $request->validate($regrasDinamicas, $disciplina->feedback());

        } else {
            $request->validate($disciplina->rules(), $disciplina->feedback());
        }
        
       //preencher o objeto $disciplina com os dados do request
        $disciplina->fill($request->all());
        //dd($disciplina->getAttributes());
        $disciplina->save();
        return response()->json($disciplina, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disciplina = $this->disciplina->find($id);
        if($disciplina === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }
        $disciplina->delete();
        return response()->json(['msg' => 'A disciplina foi removida com sucesso!'], 200);
    }
}

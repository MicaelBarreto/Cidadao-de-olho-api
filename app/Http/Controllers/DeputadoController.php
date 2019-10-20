<?php

namespace App\Http\Controllers;

use App\Deputado;
use App\Indenizacao;
use Illuminate\Http\Request;
use DB;

class DeputadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * @OA\Get(path="/deputados", summary="Lista todos os deputados", 
     * @OA\Response(response="200", description="Sucesso"),
     * @OA\Response(response="500", description="Erro Interno"),
     * @OA\Response(response="400", description="Não Encontrado"),
     * @OA\Response(response="405", description="Método não Permitido"),
     * @OA\Response(response="408", description="Time Out"))
     */
    public function index()
    {
        $deputados = Deputado::all();

        return $deputados->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deputado  $deputado
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(path="/deputados/{id}", summary="Retorna os dados de um deputado específico", 
     * @OA\Response(response="200", description="Sucesso"),
     * @OA\Response(response="500", description="Erro Interno"),
     * @OA\Response(response="400", description="Não Encontrado"),
     * @OA\Response(response="405", description="Método não Permitido"),
     * @OA\Response(response="408", description="Time Out"),
     * @OA\Parameter(description="ID do deputado", in="path", name="id", required=true))
     */
    public function show($id)
    {
        $deputado = Deputado::find($id);
        $indenizacoes = Indenizacao::where('deputado_id', $deputado->id)->get();
        $midias = DB::table('deputados_midias')
                    ->join('midias', 'deputados_midias.midia_id', 'midias.id')
                    ->where('deputados_midias.deputado_id', $deputado->id)
                    ->select('midias.nome', 'deputados_midias.url')
                    ->get();

        return response()->json(compact('deputado', 'indenizacoes', 'midias'), 200);
    }
}

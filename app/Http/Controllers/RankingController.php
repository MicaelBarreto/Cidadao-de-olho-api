<?php

namespace App\Http\Controllers;

use App\Midia;
use Illuminate\Http\Request;
use App\Services\QueryMonth;
use Carbon\Carbon;
use DB;

class RankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(path="/rankings", summary="Retorna os rankings dos top 5",
     * @OA\Response(response="200", description="Sucesso"),
     * @OA\Response(response="500", description="Erro Interno"),
     * @OA\Response(response="400", description="Não Encontrado"),
     * @OA\Response(response="405", description="Método não Permitido"),
     * @OA\Response(response="408", description="Time Out"))
     */
    public function index()
    {
        $midias = Midia::join('deputados_midias', 'midias.id', 'deputados_midias.midia_id')
                        ->select(array('midias.*', DB::raw('COUNT(deputados_midias.midia_id) m')))
                        ->groupBy('deputados_midias.midia_id')
                        ->orderBy('m', 'desc')                        
                        ->limit(5)
                        ->get();

        $deputados = QueryMonth::query(Carbon::now()->format('m'));

        return response()->json(compact('midias', 'deputados'), 200);
    }



    /**
     * @OA\Get(path="/rankings/{id}", summary="Retorna o ranking de deputados que mais pediram indenizações em determinado mês", 
     * @OA\Response(response="200", description="Sucesso"),
     * @OA\Response(response="500", description="Erro Interno"),
     * @OA\Response(response="400", description="Não Encontrado"),
     * @OA\Response(response="405", description="Método não Permitido"),
     * @OA\Response(response="408", description="Time Out"),
     * @OA\Parameter(description="Numero do mês", in="path", name="id", required=true))
     */
    public function dataChange($month)
    {
        $deputados = QueryMonth::query($month);

        return response()->json($deputados);
    }
}

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
    public function index()
    {
        $midias = Midia::join('deputados_midias', 'midias.id', 'deputados_midias.midia_id')
                        ->select(array('deputados_midias.*', DB::raw('COUNT(deputados_midias.midia_id) as midias')))
                        ->groupBy('midias.id')
                        ->orderBy('midias', 'desc')                        
                        ->limit(5)
                        ->get();

        $deputados = QueryMonth::query(Carbon::now()->format('m'));

        return response()->json(compact('midias', 'deputados'), 200);
    }

    public function dataChange($month)
    {
        $deputados = QueryMonth::query($month);

        return response()->json($deputados);
    }
}

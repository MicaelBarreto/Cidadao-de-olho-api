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
    public function show($id)
    {
        $deputado = Deputado::find($id);
        $indenizacoes = Indenizacao::where('deputado_id', $deputado->id)->get();
        $midias = DB::table('deputados_midias')
                    ->join('midias', 'deputados_midias.midia_id', 'midias.id')
                    ->where('deputados_midias.deputado_id', $deputado->id)
                    ->get();

        return response()->json(compact('deputado', 'indenizacoes', 'midias'), 200);
    }
}

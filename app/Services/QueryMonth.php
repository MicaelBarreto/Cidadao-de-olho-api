<?php

namespace App\Services;

use App\Deputado;
use DB;

class QueryMonth {
    public static function query($month) {
        $deputados = Deputado::join('indenizacaos', 'deputados.id', 'indenizacaos.deputado_id')
                                ->select(array('deputados.*', DB::raw('COUNT(indenizacaos.deputado_id) i')))
                                ->groupBy('indenizacaos.deputado_id')
                                ->orderBy('i', 'desc')
                                ->whereMonth('indenizacaos.data', '=', $month)
                                ->limit(5)
                                ->get();
        return $deputados;
    }
}
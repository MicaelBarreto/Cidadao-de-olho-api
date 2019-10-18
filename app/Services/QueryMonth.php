<?php

namespace App\Services;

use App\Deputado;

class QueryMonth {
    public static function query($month) {
        $deputados = Deputado::join('indenizacaos', 'deputados.id', 'indenizacaos.deputado_id')
                                ->orderBy('indenizacaos.deputado_id', 'desc')
                                ->whereMonth('indenizacaos.data', '=', $month)
                                ->limit(5)
                                ->get();
        
        return $deputados;
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(version="1.0.0", title="Cidadão de Olho - API", description="Documentação via swagger da API da aplicação Cidadão de Olho!",
 * @OA\Contact(email="micaelmoraes.dev@gmail.com"))
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

<?php
 
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rotas para informações dos deputados
Route::get('/deputados', 'DeputadoController@index');
Route::get('/deputados/{id}', 'DeputadoController@show');

// Rotas para informações das midias dos deputados
Route::get('/rankings', 'RankingController@index');
Route::get('/rankings/{id}', 'RankingController@dataChange');

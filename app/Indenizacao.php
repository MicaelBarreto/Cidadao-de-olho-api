<?php

namespace App;

/**
 * Class Indenizacao
 *
 * @OA\Schema(
 *     description="Model da tabela indenizacaos",
 *     title="Indenizacao model",
 *     required={"id", "data", "deputado_id"}
 * )
 */


use Illuminate\Database\Eloquent\Model;

class Indenizacao extends Model
{
    protected $table = 'indenizacaos';

    protected $dates = [
		'data'
	];

    protected $fillable = [
		'id',
		'data',
		'deputado_id',
    ];
    
    public function deputados()
    {
        return $this->belongsTo('App\Deputado');
    }
}

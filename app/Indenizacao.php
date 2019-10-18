<?php

namespace App;

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

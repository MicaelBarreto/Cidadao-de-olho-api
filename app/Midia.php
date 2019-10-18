<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Midia extends Model
{
    protected $table = 'midias';

    protected $fillable = [
		'id',
		'nome',
		'url',
    ];
    
    public function deputados()
    {
        return $this->belongsToMany('App\Deputado', 'deputados_midias', 'midia_id', 'deputado_id')->withPivot('url');
    }
}

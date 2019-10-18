<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deputado extends Model
{
    protected $table = 'deputados';

    protected $fillable = [
		'id',
		'nome',
		'partido',
    ];
    
    public function midias()
    {
        return $this->belongsToMany('App\Midia', 'deputados_midias',  'deputado_id', 'midia_id')->withPivot('url');
    }

    public function indenizacoes()
    {
        return $this->hasMany('App\Indenizacao');
    }
}

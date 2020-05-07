<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'series';
    protected $fillable = ['nome','genero','imdb','episodio_parado','temporada_parada','dados_extra'];
}

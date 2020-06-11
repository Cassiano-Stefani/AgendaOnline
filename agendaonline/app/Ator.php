<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ator extends Model
{
    protected $table = "atores";
    protected $fillable = ['nome','dt_nascimento','num_premiacoes','dados_extra'];

    public function filmes() {
        return $this->belongsToMany(Filme::class);
    }

    public function series() {
        return $this->belongsToMany(Serie::class);
    }

    public function users() {
        return $this->belongsTo('App\User');
    }
}

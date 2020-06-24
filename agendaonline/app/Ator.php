<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ator extends Model
{
    protected $table = "atores";
    protected $fillable = ['nome', 'user_id', 'dados_extra'];

    public function filmes() {
        return $this->belongsToMany(Filme::class);
    }

    public function series() {
        return $this->belongsToMany(Serie::class);
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    protected $table = 'filmes';
    protected $fillable = ['nome', 'user_id', 'ano_lancamento', 'poster', 'imdb', 'dados_extra'];

    public function atores() {
        return $this->belongsToMany(Ator::class);
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}

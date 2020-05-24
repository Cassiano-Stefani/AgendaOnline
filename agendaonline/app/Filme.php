<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    protected $table = 'filmes';
    protected $fillable = ['nome', 'ano_lancamento', 'genero', 'imdb', 'dados_extra'];

    public function atores() {
        return $this->belongsToMany(Ator::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escritor extends Model
{
    protected $table = 'escritores';
    protected $fillable = ['nome', 'user_id', 'dados_extra'];

    public function livros() {
        return $this->hasMany("App\Livro");
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escritor extends Model
{
    protected $table = 'escritores';
    protected $fillable = ['nome', 'dados_extra'];

    public function livros() {
        return $this->hasMany("App\Livro");
    }
}

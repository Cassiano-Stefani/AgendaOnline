<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livros';
    protected $fillable = ['nome','genero','escritor_id','pagina_parada','dados_extra'];

    public function escritor() {
        return $this->belongsTo("App\Escritor");
    }
}

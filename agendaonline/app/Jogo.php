<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    protected $table = "jogos";
    protected $fillable = ['nome', 'user_id','ano_lancamento','genero','completado','dados_extra'];

    public function users() {
        return $this->belongsTo('App\User');
    }
}

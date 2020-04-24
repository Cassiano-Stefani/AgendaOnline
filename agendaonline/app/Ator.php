<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ator extends Model
{
    protected $table = "atores";
    protected $fillable = ['nome','dt_nascimento','num_premiacoes','dados_extra'];
}

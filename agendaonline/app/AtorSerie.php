<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtorSerie extends Model
{
    protected $table = "ator_serie";
    protected $fillable = ['ator_id','serie_id'];
}

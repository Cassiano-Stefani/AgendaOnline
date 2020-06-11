<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtorFilme extends Model
{
    protected $table = "ator_filme";
    protected $fillable = ['ator_id','filme_id'];
}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function atores() {
        return $this->hasMany('App\Ator');
    }

    public function escritores() {
        return $this->hasMany('App\Escritor');
    }

    public function filmes() {
        return $this->hasMany('App\Filme');
    }

    public function jogos() {
        return $this->hasMany('App\Jogo');
    }

    public function livros() {
        return $this->hasMany('App\Livro');
    }

    public function series() {
        return $this->hasMany('App\Serie');
    }
}

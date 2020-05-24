<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix'=>'atores', 'where'=>['id'=>'[0-9]+']], function () {
        Route::get ('',             ['as'=>'atores',         'uses'=>'AtoresController@index'  ]);
        Route::get ('create',       ['as'=>'atores.create',  'uses'=>'AtoresController@create' ]);
        Route::get ('{id}/destroy', ['as'=>'atores.destroy', 'uses'=>'AtoresController@destroy']);
        Route::get ('{id}/edit',    ['as'=>'atores.edit',    'uses'=>'AtoresController@edit'   ]);
        Route::put ('{id}/update',  ['as'=>'atores.update',  'uses'=>'AtoresController@update' ]);
        Route::post('store',        ['as'=>'atores.store',   'uses'=>'AtoresController@store'  ]);
    });

    Route::group(['prefix'=>'jogos', 'where'=>['id'=>'[0-9]+']], function () {
        Route::get ('',             ['as'=>'jogos',         'uses'=>'JogosController@index'  ]);
        Route::get ('create',       ['as'=>'jogos.create',  'uses'=>'JogosController@create' ]);
        Route::get ('{id}/destroy', ['as'=>'jogos.destroy', 'uses'=>'JogosController@destroy']);
        Route::get ('{id}/edit',    ['as'=>'jogos.edit',    'uses'=>'JogosController@edit'   ]);
        Route::put ('{id}/update',  ['as'=>'jogos.update',  'uses'=>'JogosController@update' ]);
        Route::post('store',        ['as'=>'jogos.store',   'uses'=>'JogosController@store'  ]);
    });

    Route::group(['prefix'=>'escritores', 'where'=>['id'=>'[0-9]+']], function () {
        Route::get ('',             ['as'=>'escritores',         'uses'=>'EscritoresController@index'  ]);
        Route::get ('create',       ['as'=>'escritores.create',  'uses'=>'EscritoresController@create' ]);
        Route::get ('{id}/destroy', ['as'=>'escritores.destroy', 'uses'=>'EscritoresController@destroy']);
        Route::get ('{id}/edit',    ['as'=>'escritores.edit',    'uses'=>'EscritoresController@edit'   ]);
        Route::put ('{id}/update',  ['as'=>'escritores.update',  'uses'=>'EscritoresController@update' ]);
        Route::post('store',        ['as'=>'escritores.store',   'uses'=>'EscritoresController@store'  ]);
    });

    Route::group(['prefix'=>'livros', 'where'=>['id'=>'[0-9]+']], function () {
        Route::get ('',             ['as'=>'livros',         'uses'=>'LivrosController@index'  ]);
        Route::get ('create',       ['as'=>'livros.create',  'uses'=>'LivrosController@create' ]);
        Route::get ('{id}/destroy', ['as'=>'livros.destroy', 'uses'=>'LivrosController@destroy']);
        Route::get ('{id}/edit',    ['as'=>'livros.edit',    'uses'=>'LivrosController@edit'   ]);
        Route::put ('{id}/update',  ['as'=>'livros.update',  'uses'=>'LivrosController@update' ]);
        Route::post('store',        ['as'=>'livros.store',   'uses'=>'LivrosController@store'  ]);
    });

    Route::group(['prefix'=>'filmes', 'where'=>['id'=>'[0-9]+']], function () {
        Route::get ('',             ['as'=>'filmes',         'uses'=>'FilmesController@index'  ]);
        Route::get ('create',       ['as'=>'filmes.create',  'uses'=>'FilmesController@create' ]);
        Route::get ('{id}/destroy', ['as'=>'filmes.destroy', 'uses'=>'FilmesController@destroy']);
        Route::get ('{id}/edit',    ['as'=>'filmes.edit',    'uses'=>'FilmesController@edit'   ]);
        Route::put ('{id}/update',  ['as'=>'filmes.update',  'uses'=>'FilmesController@update' ]);
        Route::post('store',        ['as'=>'filmes.store',   'uses'=>'FilmesController@store'  ]);
    });

    Route::group(['prefix'=>'series', 'where'=>['id'=>'[0-9]+']], function () {
        Route::get ('',             ['as'=>'series',         'uses'=>'SeriesController@index'  ]);
        Route::get ('create',       ['as'=>'series.create',  'uses'=>'SeriesController@create' ]);
        Route::get ('{id}/destroy', ['as'=>'series.destroy', 'uses'=>'SeriesController@destroy']);
        Route::get ('{id}/edit',    ['as'=>'series.edit',    'uses'=>'SeriesController@edit'   ]);
        Route::put ('{id}/update',  ['as'=>'series.update',  'uses'=>'SeriesController@update' ]);
        Route::post('store',        ['as'=>'series.store',   'uses'=>'SeriesController@store'  ]);
    });
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

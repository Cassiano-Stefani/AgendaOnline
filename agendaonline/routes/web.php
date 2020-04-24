<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

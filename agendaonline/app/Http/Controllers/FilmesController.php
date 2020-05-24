<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filme;
use App\http\Requests\FilmeRequest;

class FilmesController extends Controller
{
    public function index() {
		$filmes = Filme::orderBy('nome')->paginate(8);
		return view('filmes.index', ['filmes'=>$filmes]);
	}

    public function create() {
        return view('filmes.create');
    }

    public function store(FilmeRequest $request) {
        $novo_filme = $request->all();
        Filme::create($novo_filme);
        return redirect()->route('filmes');
    }

    public function destroy($id) {
        try {
		    Filme::find($id)->delete();
			$ret = array('status'=>200, 'msg'=>"null");
		} catch (\Illuminate\Database\QueryException $e) {
			$ret = array('status'=>500, 'msg'=>$e->getMessage());
		}
		catch (\PDOException $e) {
			$ret = array('status'=>500, 'msg'=>$e->getMessage());
		}
		return $ret;
    }

    public function edit($id) {
        $filme = Filme::find($id);
        return view('filmes.edit', compact('filme'));
    }

    public function update(FilmeRequest $request, $id) {
        Filme::find($id)->update($request->all());
        return redirect()->route('filmes');
    }
}

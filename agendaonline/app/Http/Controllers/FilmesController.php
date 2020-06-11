<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filme;
use App\Ator;
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
        $filme = Filme::create([
                        'nome' => $request->get('nome'),
                        'ano_lancamento' => $request->get('ano_lancamento'),
                        'genero' => $request->get('genero'),
                        'imdb' => $request->get('imdb'),
                        'dados_extra' => $request->get('dados_extra')]
                    );

        $atores = $request->atores;
        foreach($atores as $a => $value) {
            $filme->atores()->attach(Ator::find($value));
        }

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
        $filme = Filme::find($id);

        foreach ($filme->atores as $ator) {
            $filme->atores()->detach($ator);
        }

        $filme->update([
            'nome' => $request->get('nome'),
            'ano_lancamento' => $request->get('ano_lancamento'),
            'genero' => $request->get('genero'),
            'imdb' => $request->get('imdb'),
            'dados_extra' => $request->get('dados_extra')]
        );

        $atores = $request->atores;
        if ($atores != null) {
            foreach($atores as $a => $value) {
                $filme->atores()->attach(Ator::find($value));
            }
        }

        return redirect()->route('filmes');
    }
}

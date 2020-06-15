<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filme;
use App\Ator;
use App\http\Requests\FilmeRequest;

class FilmesController extends Controller
{
    public function index(Request $filtro) {
		$filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $filmes = Filme::where('user_id', auth()->user()->id)->orderBy('nome')->paginate(8);
        else
            $filmes = Filme::where('user_id', auth()->user()->id)
                          ->where('nome', 'like', '%'.$filtragem.'%')
                          ->orderBy('nome')
                          ->paginate(8)
                          ->setPath(route('filmes'))
                          ->appends('desc_filtro', $filtragem);
		return view('filmes.index', ['filmes'=>$filmes]);
	}

    public function create() {
        return view('filmes.create');
    }

    public function store(FilmeRequest $request) {
        $auid = auth()->user()->id;
        $filme = Filme::create([
                        'nome' => $request->get('nome'),
                        'user_id' => $auid,
                        'ano_lancamento' => $request->get('ano_lancamento'),
                        'genero' => $request->get('genero'),
                        'imdb' => $request->get('imdb'),
                        'dados_extra' => $request->get('dados_extra')]
                    );

        $atores = $request->atores;
        if ($atores != null) {
            foreach($atores as $a => $value) {
                $ator = Ator::find($value);
                if ($ator->user_id == $auid) {
                    $filme->atores()->attach($ator);
                }
            }
        }

        return redirect()->route('filmes');
    }

    public function destroy($id) {
        try {
            $filme = Filme::find($id);
            if ($filme->user_id == auth()->user()->id) {
                $filme->delete();
                $ret = array('status'=>200, 'msg'=>"null");
            } else {
                $ret = array('status'=>500, 'msg'=>'Not owner of data');
            }
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
        if ($filme->user_id == auth()->user()->id) {
            return view('filmes.edit', compact('filme'));
        } else {
            return redirect()->route('filmes');
        }
    }

    public function update(FilmeRequest $request, $id) {
        $auid = auth()->user()->id;
        $filme = Filme::find($id);
        if ($filme->user_id == $auid) {
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
                    $ator = Ator::find($value);
                    if ($ator->user_id == $auid) {
                        $filme->atores()->attach($ator);
                    }
                }
            }
        }

        return redirect()->route('filmes');
    }
}

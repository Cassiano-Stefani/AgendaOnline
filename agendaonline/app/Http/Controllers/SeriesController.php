<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use App\Ator;
use App\http\Requests\SerieRequest;

class SeriesController extends Controller
{
    public function index(Request $filtro) {
		$filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $series = Serie::where('user_id', auth()->user()->id)->orderBy('nome')->paginate(10);
        else
            $series = Serie::where('user_id', auth()->user()->id)
                          ->where('nome', 'like', '%'.$filtragem.'%')
                          ->orderBy('nome')
                          ->paginate(10)
                          ->setPath(route('series'))
                          ->appends('desc_filtro', $filtragem);
		return view('series.index', ['series'=>$series]);
	}

    public function create() {
        return view('series.create');
    }

    public function store(SerieRequest $request) {
        $auid = auth()->user()->id;
        $serie = Serie::create([
                        'nome' => $request->get('nome'),
                        'user_id' => $auid,
                        'ano_lancamento' => $request->get('ano_lancamento'),
                        'poster' => $request->get('poster'),
                        'imdb' => $request->get('imdb'),
                        'temporada_parada' => $request->get('temporada_parada'),
                        'episodio_parado' => $request->get('episodio_parado'),
                        'dados_extra' => $request->get('dados_extra')]
                    );

        $atores = $request->atores;
        if ($atores != null) {
            foreach($atores as $a => $value) {
                $ator = Ator::find($value);
                if ($ator->user_id == $auid) {
                    $serie->atores()->attach($ator);
                }
            }
        }

        return redirect()->route('series');
    }

    public function destroy($id) {
        try {
            $serie = Serie::find($id);
            if ($serie->user_id == auth()->user()->id) {
                $serie->delete();
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
        $serie = Serie::find($id);
        if ($serie->user_id == auth()->user()->id) {
            return view('series.edit', compact('serie'));
        } else {
            return redirect()->route('series');
        }
    }

    public function update(SerieRequest $request, $id) {
        $auid = auth()->user()->id;
        $serie = Serie::find($id);
        if ($serie->user_id == $auid) {
            foreach ($serie->atores as $ator) {
                $serie->atores()->detach($ator);
            }

            $serie->update([
                'nome' => $request->get('nome'),
                'ano_lancamento' => $request->get('ano_lancamento'),
                'poster' => $request->get('poster'),
                'imdb' => $request->get('imdb'),
                'temporada_parada' => $request->get('temporada_parada'),
                'episodio_parado' => $request->get('episodio_parado'),
                'dados_extra' => $request->get('dados_extra')]
            );

            $atores = $request->atores;
            if ($atores != null) {
                foreach($atores as $a => $value) {
                    $ator = Ator::find($value);
                    if ($ator->user_id == $auid) {
                        $serie->atores()->attach($ator);
                    }
                }
            }
        }

        return redirect()->route('series');
    }
}

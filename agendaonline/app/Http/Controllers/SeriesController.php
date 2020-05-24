<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use App\http\Requests\SerieRequest;

class SeriesController extends Controller
{
    public function index() {
		$series = Serie::orderBy('nome')->paginate(8);
		return view('series.index', ['series'=>$series]);
	}

    public function create() {
        return view('series.create');
    }

    public function store(SerieRequest $request) {
        $nova_serie = $request->all();
        Serie::create($nova_serie);
        return redirect()->route('series');
    }

    public function destroy($id) {
        try {
		    Serie::find($id)->delete();
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
        return view('series.edit', compact('serie'));
    }

    public function update(SerieRequest $request, $id) {
        Serie::find($id)->update($request->all());
        return redirect()->route('series');
    }
}

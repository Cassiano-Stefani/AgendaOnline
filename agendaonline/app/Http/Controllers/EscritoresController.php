<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Escritor;
use App\Http\Requests\EscritorRequest;

class EscritoresController extends Controller
{
    public function index() {
		$escritores = Escritor::orderBy('nome')->paginate(8);
		return view('escritores.index', ['escritores'=>$escritores]);
	}

    public function create() {
        return view('escritores.create');
    }

    public function store(EscritorRequest $request) {
        $novo_escritor = $request->all();
        Escritor::create($novo_escritor);
        return redirect()->route('escritores');
    }

    public function destroy($id) {
        try {
		    Escritor::find($id)->delete();
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
        $escritor = Escritor::find($id);
        return view('escritores.edit', compact('escritor'));
    }

    public function update(EscritorRequest $request, $id) {
        Escritor::find($id)->update($request->all());
        return redirect()->route('escritores');
    }
}

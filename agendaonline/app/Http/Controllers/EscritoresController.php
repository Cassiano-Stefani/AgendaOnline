<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Escritor;
use App\Http\Requests\EscritorRequest;

class EscritoresController extends Controller
{
    public function index(Request $filtro) {
		$filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $escritores = Escritor::where('user_id', auth()->user()->id)->orderBy('nome')->paginate(8);
        else
            $escritores = Escritor::where('user_id', auth()->user()->id)
                          ->where('nome', 'like', '%'.$filtragem.'%')
                          ->orderBy('nome')
                          ->paginate(8)
                          ->setPath(route('escritores'))
                          ->appends('desc_filtro', $filtragem);
		return view('escritores.index', ['escritores'=>$escritores]);
	}

    public function create() {
        return view('escritores.create');
    }

    public function store(EscritorRequest $request) {
        $novo_escritor = $request->all();
        $novo_escritor['user_id'] = auth()->user()->id;
        Escritor::create($novo_escritor);
        return redirect()->route('escritores');
    }

    public function destroy($id) {
        try {
            $escritor = Escritor::find($id);
            if ($escritor->user_id == auth()->user()->id) {
                $escritor->delete();
                $ret = array('status'=>200, 'msg'=>"null");
            } else {
                $ret = array('status'=>500, 'msg'=>'Not owner of data');
            }
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
        if ($escritor->user_id == auth()->user()->id) {
            return view('escritores.edit', compact('escritor'));
        } else {
            return redirect()->route('escritores');
        }
    }

    public function update(EscritorRequest $request, $id) {
        $escritor = Escritor::find($id);
        if ($escritor->user_id == auth()->user()->id) {
            $escritor->update($request->all());
        }

        return redirect()->route('escritores');
    }
}

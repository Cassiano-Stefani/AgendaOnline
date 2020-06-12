<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ator;
use App\Http\Requests\AtorRequest;

class AtoresController extends Controller
{
    public function index() {
		$atores = Ator::where('user_id', auth()->user()->id)->orderBy('nome')->paginate(8);
		return view('atores.index', ['atores'=>$atores]);
	}

    public function create() {
        return view('atores.create');
    }

    public function store(AtorRequest $request) {
        $novo_ator = $request->all();
        $novo_ator['user_id'] = auth()->user()->id;
        Ator::create($novo_ator);
        return redirect()->route('atores');
    }

    public function destroy($id) {
        try {
            $ator = Ator::find($id);
            if ($ator->user_id == auth()->user()->id) {
                $ator->delete();
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
        $ator = Ator::find($id);
        if ($ator->user_id == auth()->user()->id) {
            return view('atores.edit', compact('ator'));
        } else {
            return redirect()->route('atores');
        }
    }

    public function update(AtorRequest $request, $id) {
        $ator = Ator::find($id);
        if ($ator->user_id == auth()->user()->id) {
            $ator->update($request->all());
        }

        return redirect()->route('atores');
    }
}

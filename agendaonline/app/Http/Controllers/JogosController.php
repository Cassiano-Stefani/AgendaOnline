<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jogo;
use App\Http\Requests\JogoRequest;

class JogosController extends Controller
{
    public function index() {
		$jogos = Jogo::where('user_id', auth()->user()->id)->orderBy('nome')->paginate(8);
		return view('jogos.index', ['jogos'=>$jogos]);
	}

    public function create() {
        return view('jogos.create');
    }

    public function store(JogoRequest $request) {
        $novo_jogo = $request->all();
        $novo_jogo['user_id'] = auth()->user()->id;
        Jogo::create($novo_jogo);
        return redirect()->route('jogos');
    }

    public function destroy($id) {
        try {
            $jogo = Jogo::find($id);
            if ($jogo->user_id == auth()->user()->id) {
                $jogo->delete();
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
        $jogo = Jogo::find($id);
        if ($jogo->user_id == auth()->user()->id) {
            return view('jogos.edit', compact('jogo'));
        } else {
            return redirect()->route('jogos');
        }
    }

    public function update(JogoRequest $request, $id) {
        $jogo = Jogo::find($id);
        if ($jogo->user_id == auth()->user()->id) {
            $jogo->update($request->all());
        }

        return redirect()->route('jogos');
    }
}

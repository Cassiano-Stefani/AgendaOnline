<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jogo;
use App\Http\Requests\JogoRequest;

class JogosController extends Controller
{
    public function index() {
		$jogos = Jogo::orderBy('nome')->paginate(8);
		return view('jogos.index', ['jogos'=>$jogos]);
	}

    public function create() {
        return view('jogos.create');
    }

    public function store(JogoRequest $request) {
        $novo_jogo = $request->all();
        Jogo::create($novo_jogo);
        return redirect()->route('jogos');
    }

    public function destroy($id) {
        Jogo::find($id)->delete();
        return redirect()->route('jogos');
    }

    public function edit($id) {
        $jogo = Jogo::find($id);
        return view('jogos.edit', compact('jogo'));
    }

    public function update(JogoRequest $request, $id) {
        Jogo::find($id)->update($request->all());
        return redirect()->route('jogos');
    }
}

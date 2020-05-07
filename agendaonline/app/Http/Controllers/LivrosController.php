<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Livro;
use App\Http\Requests\LivroRequest;

class LivrosController extends Controller
{
    public function index() {
		$livros = Livro::orderBy('nome')->paginate(8);
		return view('livros.index', ['livros'=>$livros]);
	}

    public function create() {
        return view('livros.create');
    }

    public function store(LivroRequest $request) {
        $novo_livro = $request->all();
        Livro::create($novo_livro);
        return redirect()->route('livros');
    }

    public function destroy($id) {
        Livro::find($id)->delete();
        return redirect()->route('livros');
    }

    public function edit($id) {
        $livro = Livro::find($id);
        return view('livros.edit', compact('livro'));
    }

    public function update(LivroRequest $request, $id) {
        Livro::find($id)->update($request->all());
        return redirect()->route('livros');
    }
}

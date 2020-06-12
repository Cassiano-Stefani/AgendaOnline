<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Livro;
use App\Http\Requests\LivroRequest;

class LivrosController extends Controller
{
    public function index() {
		$livros = Livro::where('user_id', auth()->user()->id)->orderBy('nome')->paginate(8);
		return view('livros.index', ['livros'=>$livros]);
	}

    public function create() {
        return view('livros.create');
    }

    public function store(LivroRequest $request) {
        $novo_livro = $request->all();
        $novo_livro['user_id'] = auth()->user()->id;
        Livro::create($novo_livro);
        return redirect()->route('livros');
    }

    public function destroy($id) {
        try {
            $livro = Livro::find($id);
            if ($livro->user_id == auth()->user()->id) {
                $livro->delete();
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
        $livro = Livro::find($id);
        if ($livro->user_id == auth()->user()->id) {
            return view('livros.edit', compact('livro'));
        } else {
            return redirect()->route('livros');
        }
    }

    public function update(LivroRequest $request, $id) {
        $livro = Livro::find($id);
        if ($livro->user_id == auth()->user()->id) {
            $livro->update($request->all());
        }

        return redirect()->route('livros');
    }
}

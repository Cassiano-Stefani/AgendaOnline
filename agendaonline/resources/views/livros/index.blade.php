@extends('layouts.default')

@section('content')
    <h1>Livros</h1>
    <table class="table table-stripe table-bordered table-hover">
        <thead>
            <th>Título</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach($livros as $livro)
                <tr>
                    <td>{{ $livro->nome }} </td>
                    <td>
                        <a href="{{ route('livros.edit', ['id'=>$livro->id]) }}"    class="btn-sm btn-success">Editar</a>
                        <a href="#" onclick="return ConfirmaExclusao({{ $livro->id }})" class="btn-sm btn-danger">Remover</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $livros->links() }}

    <a href="{{ route('livros.create', []) }}" class="btn-sm btn-info">Adicionar</a>
@stop

@section('table-delete')
"livros"
@stop

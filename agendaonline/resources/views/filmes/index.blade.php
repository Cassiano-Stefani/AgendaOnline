@extends('layouts.default')

@section('content')
    <h1>Filmes</h1>
    <table class="table table-stripe table-bordered table-hover">
        <thead>
            <th>Título</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach($filmes as $filme)
                <tr>
                    <td>{{ $filme->nome }} </td>
                    <td>
                        <a href="{{ route('filmes.edit', ['id'=>$filme->id]) }}"    class="btn-sm btn-success">Editar</a>
                        <a href="#" onclick="return ConfirmaExclusao({{ $filme->id }})" class="btn-sm btn-danger">Remover</a>
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>

    {{ $filmes->links() }}

    <a href="{{ route('filmes.create', []) }}" class="btn-sm btn-info">Adicionar</a>
@stop

@section('table-delete')
"filmes"
@stop

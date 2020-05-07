@extends('layouts.default')

@section('content')
    <h1>Jogos</h1>
    <table class="table table-stripe table-bordered table-hover">
        <thead>
            <th>Título</th>
            <th>Ano de Lançamento</th>
            <th>Gênero</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach($jogos as $jogo)
                <tr>
                    <td>{{ $jogo->nome }} </td>
                    <td>{{ Carbon\Carbon::parse($jogo->ano_lancamento)->format('d/m/Y') }} </td>
                    <td>{{ $jogo->genero }} </td>
                    <td>
                        <a href="{{ route('jogos.edit', ['id'=>$jogo->id]) }}"    class="btn-sm btn-success">Editar</a>
                        <a href="#" onclick="return ConfirmaExclusao({{ $jogo->id }})" class="btn-sm btn-danger">Remover</a>
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>

    {{ $jogos->links() }}

    <a href="{{ route('jogos.create', []) }}" class="btn-sm btn-info">Adicionar</a>
@stop

@section('table-delete')
"jogos"
@stop

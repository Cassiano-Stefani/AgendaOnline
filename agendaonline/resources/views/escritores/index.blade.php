@extends('layouts.default')

@section('content')
    <h1>Escritores</h1>
    <table class="table table-stripe table-bordered table-hover">
        <thead>
            <th>Nome</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach($escritores as $escritor)
                <tr>
                    <td>{{ $escritor->nome }} </td>
                    <td>
                        <a href="{{ route('escritores.edit', ['id'=>$escritor->id]) }}"    class="btn-sm btn-success">Editar</a>
                        <a href="#" onclick="return ConfirmaExclusao({{ $escritor->id }})" class="btn-sm btn-danger">Remover</a>
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>

    {{ $escritores->links() }}

    <a href="{{ route('escritores.create', []) }}" class="btn-sm btn-info">Adicionar</a>
@stop

@section('table-delete')
"escritores"
@stop

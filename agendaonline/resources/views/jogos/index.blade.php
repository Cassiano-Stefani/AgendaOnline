@extends('layouts.default')

@section('content')
    <h1 style="display: inline-block;">Jogos</h1>
    <a href="{{ route('jogos.create', []) }}" class="btn-sm btn-info" style="font-size: 21px; float: right; bottom: -5px; position: relative;">Adicionar</a>

    {!! Form::open(['name'=>'form_name', 'route'=>'jogos']) !!}
        <div calss="sidebar-form">
            <div class="input-group">
                <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placeholder="Pesquisa...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>
    {!! Form::close() !!}
    <br>

    <table class="table table-stripe table-bordered table-hover">
        <thead>
            <th>Título</th>
            <th>Progresso</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach($jogos as $jogo)
                <tr>
                    <td>{{ $jogo->nome }} </td>
                    <td>{{ $jogo->completado }} </td>
                    <td>
                        <a href="{{ route('jogos.edit', ['id'=>$jogo->id]) }}"    class="btn-sm btn-success">Editar</a>
                        <a href="#" onclick="return ConfirmaExclusao({{ $jogo->id }})" class="btn-sm btn-danger">Remover</a>
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>

    {{ $jogos->links() }}
@stop

@section('table-delete')
"jogos"
@stop

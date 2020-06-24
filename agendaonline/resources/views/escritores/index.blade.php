@extends('layouts.default')

@section('content')
    <h1 style="display: inline-block;">Escritores</h1>
    <a href="{{ route('escritores.create', []) }}" class="btn-sm btn-info" style="font-size: 21px; float: right; bottom: -5px; position: relative;">Adicionar</a>

    {!! Form::open(['name'=>'form_name', 'route'=>'escritores']) !!}
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
@stop

@section('table-delete')
"escritores"
@stop

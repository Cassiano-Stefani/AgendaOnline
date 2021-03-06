@extends('layouts.default')

@section('content')
    <h1 style="display: inline-block;">Livros</h1>
    <a href="{{ route('livros.create', []) }}" class="btn-sm btn-info" style="font-size: 21px; float: right; bottom: -5px; position: relative;">Adicionar</a>

    {!! Form::open(['name'=>'form_name', 'route'=>'livros']) !!}
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
            @foreach($livros as $livro)
                <tr>
                    <td>{{ $livro->nome }} </td>
                    <td>{{ $livro->pagina_parada }} </td>
                    <td>
                        <a href="{{ route('livros.edit', ['id'=>$livro->id]) }}"    class="btn-sm btn-success">Editar</a>
                        <a href="#" onclick="return ConfirmaExclusao({{ $livro->id }})" class="btn-sm btn-danger">Remover</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $livros->links() }}
@stop

@section('table-delete')
"livros"
@stop

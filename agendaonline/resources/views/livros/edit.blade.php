@extends('adminlte::page')

@section('content')
    <h3>Editando Livro: {{ $livro->nome }}</h3>

    @if($errors->any())
        <ul> class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    @endif

    {!! Form::open(['route'=>["livros.update", 'id'=>$livro->id], 'method' => 'put']) !!}
        <div class="form-group">
            {!! Form::label('nome', 'Título:') !!}
            {!! Form::text('nome', $livro->nome, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('genero', 'Gênero:') !!}
            {!! Form::text('genero', $livro->genero, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('escritor_id', 'Escritor:') !!}
            {!! Form::select('escritor_id',
                            \App\Escritor::orderBy('nome')->pluck('nome', 'id')->toArray(),
                            $livro->escritor_id, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('pagina_parada', 'Página parada:') !!}
            {!! Form::number('pagina_parada', $livro->pagina_parada, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('dados_extra', 'Observações:') !!}
            {!! Form::textarea('dados_extra', $livro->dados_extra, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Editar Livro', ['class'=>'btn btn-primary']) !!}
            {!! Form::reset('Limpar', ['class'=>'btn btn-default']) !!}
        </div>
    {!! Form::close() !!}
@stop

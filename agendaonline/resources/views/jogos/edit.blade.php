@extends('adminlte::page')

@section('content')
    <h3>Editando Jogo: {{ $jogo->nome }}</h3>

    @if($errors->any())
        <ul> class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    @endif

    {!! Form::open(['route'=>["jogos.update", 'id'=>$jogo->id], 'method' => 'put']) !!}
        <div class="form-group">
            {!! Form::label('nome', 'Título:') !!}
            {!! Form::text('nome', $jogo->nome, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('ano_lancamento', 'Ano de Lançamento:') !!}
            {!! Form::date('ano_lancamento', $jogo->ano_lancamento, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('genero', 'Gênero:') !!}
            {!! Form::text('genero', $jogo->genero, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('completado', 'Porcentagem Completa:') !!}
            {!! Form::number('completado', $jogo->completado, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('dados_extra', 'Observações:') !!}
            {!! Form::textarea('dados_extra', $jogo->dados_extra, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Editar Jogo', ['class'=>'btn btn-primary']) !!}
            {!! Form::reset('Limpar', ['class'=>'btn btn-default']) !!}
        </div>
    {!! Form::close() !!}
@stop

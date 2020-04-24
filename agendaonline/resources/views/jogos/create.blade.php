@extends('adminlte::page')

@section('content')
    <h3>Novo Jogo</h3>

    @if($errors->any())
        <ul> class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    @endif

    {!! Form::open(['route'=>'jogos.store']) !!}
        <div class="form-group">
            {!! Form::label('nome', 'Título:') !!}
            {!! Form::text('nome', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('ano_lancamento', 'Ano de Lançamento:') !!}
            {!! Form::date('ano_lancamento', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('genero', 'Gênero:') !!}
            {!! Form::text('genero', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('completado', 'Porcentagem Completa:') !!}
            {!! Form::number('completado', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('dados_extra', 'Observações:') !!}
            {!! Form::textarea('dados_extra', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Criar Jogo', ['class'=>'btn btn-primary']) !!}
            {!! Form::reset('Limpar', ['class'=>'btn btn-default']) !!}
        </div>
    {!! Form::close() !!}
@stop

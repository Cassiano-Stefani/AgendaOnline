@extends('adminlte::page')

@section('content')
    <h3>Novo Ator</h3>

    @if($errors->any())
        <ul> class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    @endif

    {!! Form::open(['route'=>'atores.store']) !!}
        <div class="form-group">
            {!! Form::label('nome', 'Nome:') !!}
            {!! Form::text('nome', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('dt_nascimento', 'Data de Nascimento:') !!}
            {!! Form::date('dt_nascimento', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('num_premiacoes', 'Número de premiações:') !!}
            {!! Form::number('num_premiacoes', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('dados_extra', 'Observações:') !!}
            {!! Form::textarea('dados_extra', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Criar Ator', ['class'=>'btn btn-primary']) !!}
            {!! Form::reset('Limpar', ['class'=>'btn btn-default']) !!}
        </div>
    {!! Form::close() !!}
@stop

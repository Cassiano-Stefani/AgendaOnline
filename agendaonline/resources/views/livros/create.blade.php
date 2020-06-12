@extends('adminlte::page')

@section('content')
    <h3>Novo Livro</h3>

    @if($errors->any())
        <ul> class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    @endif

    {!! Form::open(['route'=>'livros.store']) !!}
        <div class="form-group">
            {!! Form::label('nome', 'Título:') !!}
            {!! Form::text('nome', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('genero', 'Gênero:') !!}
            {!! Form::text('genero', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('escritor_id', 'Escritor:') !!}
            {!! Form::select('escritor_id',
                             \App\Escritor::where('user_id', auth()->user()->id)->orderBy('nome')->pluck('nome', 'id')->toArray(),
                             null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('pagina_parada', 'Progresso:') !!}
            {!! Form::text('pagina_parada', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('dados_extra', 'Observações:') !!}
            {!! Form::textarea('dados_extra', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Criar Livro', ['class'=>'btn btn-primary']) !!}
            {!! Form::reset('Limpar', ['class'=>'btn btn-default']) !!}
        </div>
    {!! Form::close() !!}
@stop

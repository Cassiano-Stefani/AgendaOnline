@extends('adminlte::page')

@section('content')
    <h3>Editando Filme: {{ $filme->nome }}</h3>

    @if($errors->any())
        <ul> class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    @endif

    {!! Form::open(['route'=>["filmes.update", 'id'=>$filme->id], 'method' => 'put']) !!}
        <div class="form-group">
            {!! Form::label('nome', 'Título:') !!}
            {!! Form::text('nome', $filme->nome, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('ano_lancamento', 'Ano de Lançamento:') !!}
            {!! Form::date('ano_lancamento', $filme->ano_lancamento, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('genero', 'Gênero:') !!}
            {!! Form::text('genero', $filme->genero, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('imdb', 'Nota:') !!}
            {!! Form::number('imdb', $filme->imdb, ['class'=>'form-control']) !!}
        </div>

        <hr />
        <h4>Atores</h4>
        <div class="input_fields_wrap">
        </div>
        <br>

        <button style="float:right" class="add_field_button btn btn-default">Adicionar Ator</button>

        <br>
        <hr />

        <div class="form-group">
            {!! Form::label('dados_extra', 'Observações:') !!}
            {!! Form::textarea('dados_extra', $filme->dados_extra, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Editar Filme', ['class'=>'btn btn-primary']) !!}
            {!! Form::reset('Limpar', ['class'=>'btn btn-default']) !!}
        </div>
    {!! Form::close() !!}
@stop

@section('js')
	<script>
		$(document).ready(function(){
			var wrapper = $(".input_fields_wrap");
			var add_button = $(".add_field_button");
            $(add_button).click(function(e) {
                var newField = '<div><div style="width:94%; float:left" id="ator">{!! Form::select("atores[]", \App\Ator::orderBy("nome")->pluck("nome","id")->toArray(), null, ["class"=>"form-control", "required", "placeholder"=>"Selecione um ator"]) !!}</div><button type="button" class="remove_field btn btn-danger btn-circle"><i class="fa fa-times"></button></div>';
			    $(wrapper).append(newField);
            });
            $(wrapper).on("click",".remove_field", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
            });
            @foreach($filme->atores as $ator)
                $(wrapper).append('<div><div style="width:94%; float:left" id="ator">{!! Form::select("atores[]", \App\Ator::orderBy("nome")->pluck("nome","id")->toArray(), $ator->id, ["class"=>"form-control", "required", "placeholder"=>"Selecione um ator"]) !!}</div><button type="button" class="remove_field btn btn-danger btn-circle"><i class="fa fa-times"></button></div>');
            @endforeach
		})
	</script>

@stop

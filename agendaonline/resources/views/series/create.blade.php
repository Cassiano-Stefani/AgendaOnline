@extends('adminlte::page')

@section('adminlte_css')
    <style>
        .resultTitle {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 220px;
        }

        .mresult {
            display: inline-block;
            padding: 10px;
            width: 240px;
            background-color: #f1f2f3;
            border-radius: 10px;
            border-width: 0px;
            margin-right: 20px;
            cursor: pointer;
        }

        .hide {
            display: none !important;
        }

        .selMov {
            background-color: #56b2e8 !important;
        }

        #horizontalDiv {
            display: flex;
            overflow: auto;
        }

        #posterImgDiv {
            text-align: left;
            padding: 20px;
            margin-top: 20px;
            background-color: white;
            border-radius: 15px;
            display: inline-block;
        }
    </style>
@stop

@section('content')
    <h3>Nova Série</h3>

    @if($errors->any())
        <ul> class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    @endif

    {!! Form::open(['route'=>'series.store']) !!}
        <div class="sidebar-form">
            {!! Form::label('nome', 'Título:') !!}
            <div class="input-group">
                {!! Form::text('nome', null, ['id'=>'movTitle', 'class'=>'form-control', 'required', 'style'=>'width:80%; margin-right:10px !important;']) !!}
                {!! Form::button('Busca TMDB', ['id'=>'searchtmdb', 'class'=>'btn btn-primary']) !!}
            </div>
        </div>

        <div id="tmdbResults" class="card mt-2 hide">
            <div class="card-header">
                <h3 class="card-title">Resultados encontrados (escolha o correto)</h3>
                {!! Form::button('Pronto', ['id'=>'donesel', 'class'=>'btn btn-primary','style'=>'float: right;']) !!}
            </div>
            <div class="card-body">
                <div id="horizontalDiv">
                </div>
            </div>
        </div>

        <div id="posterImgDiv" class="hide">
            <img id="posterImg" src="" style="width: 250px; height: auto;"></img>
        </div>

        <hr />

        {!! Form::text('poster', null, ['id'=>'movPoster', 'class'=>'hide']) !!}

        <div class="form-group">
            {!! Form::label('ano_lancamento', 'Ano de Lançamento:') !!}
            {!! Form::date('ano_lancamento', null, ['id'=>'movDate', 'class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('imdb', 'Nota:') !!}
            {!! Form::number('imdb', null, ['id'=>'movScore', 'class'=>'form-control', 'step'=>'0.001']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('temporada_parada', 'Temporada parada:') !!}
            {!! Form::number('temporada_parada', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('episodio_parado', 'Episódio parado:') !!}
            {!! Form::number('episodio_parado', null, ['class'=>'form-control']) !!}
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
            {!! Form::textarea('dados_extra', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Criar Série', ['class'=>'btn btn-primary']) !!}
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
                var newField = '<div class="input-group" style="margin-bottom: 10px;">{!! Form::select("atores[]", \App\Ator::where("user_id", auth()->user()->id)->orderBy("nome")->pluck("nome","id")->toArray(), null, ["class"=>"form-control", "required", "placeholder"=>"Selecione um ator", "style"=>"margin-right: 10px;"]) !!}<button type="button" class="remove_field btn btn-danger btn-circle"><i class="fa fa-times"></button></div>';
			    $(wrapper).append(newField);
            });

            $(wrapper).on("click",".remove_field", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
            });

            $("#searchtmdb").click(function(e) {
                var title = $("#movTitle").val();

                if (title.trim()) {
                    $.ajax({url: "/searchtmdb",
                    type: "GET",
                    data: { title: title, serie: true},
                    success: function(result){
                        if (result && result.length > 0) {
                            $("#tmdbResults").removeClass("hide");
                            $("#posterImgDiv").addClass("hide");
                            $("#horizontalDiv").empty();
                            for (var i = 0; i < result.length; i++) {
                                var movie = result[i];
                                var poster = "";
                                if (movie.poster) {
                                    poster = "https://image.tmdb.org/t/p/w220_and_h330_bestv2/" + movie.poster;
                                } else {
                                    poster = "{!! asset('images/noimg_w220_h330.png') !!}";
                                }
                                $("#horizontalDiv").append('<div class="mresult">' +
                                                           '<h5 class="resultTitle" data-toggle="tooltip" title="' + movie.title + '">' + movie.title + '</h5>' +
                                                           '<hr style="margin: 0px -10px 10px -10px;"/>'+
                                                           '<img src="' + poster + '"></img>'+
                                                           '<span class="movTitle hide">' + movie.title + '</span>'+
                                                           '<span class="movPoster hide">' + (movie.poster ? movie.poster : "noimg")  + '</span>'+
                                                           '<span class="movDate hide">' + movie.date + '</span>'+
                                                           '<span class="movScore hide">' + movie.score + '</span>'+
                                                           '</div>');
                            }
                        } else {
                            alert("Nenhuma série encontrada com este título");
                        }
                    },
                    error: function() {
                        alert("Ocorreu algum erro desconhecido!");
                    }});
                }
            });

            $("#donesel").click(function(e) {
                var sel = $(".selMov");
                if (sel) {
                    var mov = sel.first();
                    if (mov) {
                        $("#movTitle").val(mov.children(".movTitle").html());
                        $("#movPoster").val(mov.children(".movPoster").html());
                        $("#movDate").val(mov.children(".movDate").html());
                        $("#movScore").val(mov.children(".movScore").html());

                        $("#horizontalDiv").empty();
                        $("#tmdbResults").addClass("hide");

                        var poster = $("#movPoster").val();
                        if (poster && poster != "noimg") {
                            $("#posterImgDiv").removeClass("hide");
                            $("#posterImg").attr("src","https://image.tmdb.org/t/p/w220_and_h330_bestv2/" + poster);
                        }
                    }
                }
            });

            $("#horizontalDiv").on('click',".mresult", function(e) {
                $(".selMov").removeClass("selMov");
                $(this).addClass("selMov");
            });
		})
	</script>

@stop


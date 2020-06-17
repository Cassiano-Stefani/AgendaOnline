@extends('layouts.default')

@section('adminlte_css')
    <style>
        .resultTitle {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 230px;
        }

        .movie {
            display: inline-block;
            padding: 10px;
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            border-width: 0px;
            margin-right: 20px;
            margin-bottom: 30px;
            cursor: pointer;
        }

        .movieHeader {
            display: flex;
        }

        .hide {
            display: none;
        }
    </style>
@stop

@section('content')
    <h1>Filmes</h1>

    {!! Form::open(['name'=>'form_name', 'route'=>'filmes']) !!}
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

    @foreach ($filmes as $filme)
        <div class="movie" onclick="window.location = '{{ route('filmes.edit', ['id'=>$filme->id]) }}';">
            <div class="movieHeader">
                <h5 class="resultTitle" data-toggle="tooltip" title="{!! $filme->nome !!}">{!! $filme->nome !!}</h5>
                <div style="margin-left: 24px;">
                    <a href="#" onclick="return ConfirmaExclusao({{ $filme->id }})" class="delMov btn-sm btn-danger"><i class="fas fa-times"></i></a>
                </div>
            </div>
            <hr style="margin: 0px -10px 10px -10px;"/>
            <img src="{!! ($filme->poster == null || $filme->poster == "noimg" ? asset('images/noimg_w300_h450.png') : "https://image.tmdb.org/t/p/w300_and_h450_bestv2/".$filme->poster) !!}" style="width: 100%;"></img>
        </div>
    @endforeach

    <hr />

    {{ $filmes->links() }}

    <a href="{{ route('filmes.create', []) }}" class="btn-sm btn-info">Adicionar</a>

    <hr />
@stop

@section ('extrajs')
    <script>
        $(document).ready(function() {
            $(".delMov").click(function(e) {
                e.stopPropagation();
            });
        });
    </script>
@stop

@section('table-delete')
"filmes"
@stop

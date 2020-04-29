<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filmes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->date('ano_lancamento')->nullable();
            $table->string('genero')->nullable();
            $table->float('imdb', 8, 2)->nullable(); // deve ser buscado de api de terceiros
            $table->longText('dados_extra')->nullable();
            // elenco eh N pra N, tabela AtorFilme
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filmes');
    }
}

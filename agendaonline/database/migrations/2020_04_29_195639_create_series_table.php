<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100)->nullable();
            $table->string('genero')->nullable();
            $table->float('imdb', 8, 2)->nullable(); // deve ser buscado de api de terceiros
            $table->integer('episodio_parado')->nullable();
            $table->integer('temporada_parada')->nullable();
            $table->longText('dados_extra')->nullable();
            // elenco eh N pra N, tabela AtorSerie
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
        Schema::dropIfExists('series');
    }
}

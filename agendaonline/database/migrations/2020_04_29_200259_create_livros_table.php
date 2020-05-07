<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('genero', 100)->nullable();
            $table->integer('escritor_id')->unsigned()->nullable();
            $table->foreign('escritor_id')->references('id')->on('escritores');
            $table->integer('pagina_parada')->nullable();
            $table->longText('dados_extra')->nullable();
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
        Schema::dropIfExists('livros');
    }
}

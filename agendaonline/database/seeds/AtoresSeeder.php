<?php

use Illuminate\Database\Seeder;
use App\Ator;

class AtoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ator::create(['nome' => 'Robert De Niro', 'dt_nascimento' => '1943-08-17']);
        Ator::create(['nome' => 'Leonardo DiCaprio', 'dt_nascimento' => '1974-11-11']);
        Ator::create(['nome' => 'Morgan Freeman', 'dt_nascimento' => '1937-06-01']);
        Ator::create(['nome' => 'Johnny Depp', 'dt_nascimento' => '1963-06-09']);
        Ator::create(['nome' => 'Katharine Hepburn', 'dt_nascimento' => '1907-05-12']);
        Ator::create(['nome' => 'Kate Winslet', 'dt_nascimento' => '1975-10-05']);
        Ator::create(['nome' => 'Angela Bassett', 'dt_nascimento' => '1958-08-16']);
        Ator::create(['nome' => 'Will Smith', 'dt_nascimento' => '1968-09-25']);
        Ator::create(['nome' => 'Harrison Ford', 'dt_nascimento' => '1942-07-13']);
        Ator::create(['nome' => 'Antonio Banderas', 'dt_nascimento' => '1960-08-10']);
    }
}

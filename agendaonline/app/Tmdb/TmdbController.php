<?php

namespace App\Tmdb;

use Doctrine\Common\Cache\ArrayCache;

class TmdbController
{
    static private $instance;

    public $token;
    public $client;
    public $search_repo;

    private function __construct() {
        $this->token = new \Tmdb\ApiToken('4314d5175667ddb85b749cbe457636f8');
        $this->client = new \Tmdb\Client($this->token, [
            'cache' => [
                'handler' => new ArrayCache()
            ]
        ]);
        $this->search_repo = new \Tmdb\Repository\SearchRepository($this->client);
    }

    private static function init()
    {
        self::$instance = new TmdbController();
    }

    public static function instance() {
        if (self::$instance == null)
            self::init();

        return self::$instance;
    }
}



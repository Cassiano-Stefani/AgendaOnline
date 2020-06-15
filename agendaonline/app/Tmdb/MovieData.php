<?php

namespace App\Tmdb;

class MovieData
{
    public $title;
    public $releaseDate;
    public $score;
    public $posterPath;

    public function __construct($title, $releaseDate, $score, $posterPath)
    {
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->score = $score;
        $this->posterPath = $posterPath;
    }

    public function toArray() {
        $data['title'] = $this->title;
        $data['releaseDate'] = $this->releaseDate;
        $data['score'] = $this->score;
        $data['posterPath'] = $this->posterPath;

        return $data;
    }
}

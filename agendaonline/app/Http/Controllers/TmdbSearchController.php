<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tmdb\TmdbController;

class TmdbSearchController extends Controller
{
    public function search(Request $busca) {
        $serie = $busca->get("serie");
        $title = $busca->get('title');
        if ($title != null) {
            if ($serie == null) {
                $resultCollection = TmdbController::instance()->search_repo->searchMovie($title, (new \Tmdb\Model\Search\SearchQuery\MovieSearchQuery())->includeAdult(false));

                if ($resultCollection != null) {
                    $i = 0;
                    foreach ($resultCollection->toArray() as $movie) {
                        $resp[$i] = array('title'=>$movie->getTitle(),'date'=>$movie->getReleaseDate()->format('Y-m-d'), 'poster'=>$movie->getPosterPath(), 'score'=>$movie->getVoteAverage());
                        $i++;
                    }
                }
            } else {
                $resultCollection = TmdbController::instance()->search_repo->searchTv($title, new \Tmdb\Model\Search\SearchQuery\TvSearchQuery());

                if ($resultCollection != null) {
                    $i = 0;
                    foreach ($resultCollection->toArray() as $tvshow) {
                        $resp[$i] = array('title'=>$tvshow->getName(),'date'=>$tvshow->getFirstAirDate()->format('Y-m-d'), 'poster'=>$tvshow->getPosterPath(), 'score'=>$tvshow->getVoteAverage());
                        $i++;
                    }
                }
            }
        }
		return response()->json($resp);
	}
}

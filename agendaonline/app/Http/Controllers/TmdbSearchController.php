<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tmdb\TmdbController;

class TmdbSearchController extends Controller
{
    public function search(Request $busca) {
        $title = $busca->get('title');
        if ($title != null) {
            $resultCollection = TmdbController::instance()->search_repo->searchMovie($title, (new \Tmdb\Model\Search\SearchQuery\MovieSearchQuery())->includeAdult(false));

            if ($resultCollection != null) {
                $i = 0;
                foreach ($resultCollection->toArray() as $movie) {
                    $resp[$i] = array('title'=>$movie->getTitle(),'date'=>$movie->getReleaseDate(), 'poster'=>$movie->getPosterPath(), 'score'=>$movie->getVoteAverage());
                    $i++;
                }
            }
        }
		return response()->json($resp);
	}
}

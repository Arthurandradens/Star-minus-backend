<?php

namespace App\Service;

use App\Repository\MovieRepository;

class MovieService
{
    // Attributes
    private MovieRepository $movieRepository;

    // Methods
    public function __construct( MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function getMovies()
    {
       return $this->movieRepository::all();
    }

    public function getOneMovie($movie_id)
    {
        return $this->movieRepository::findByMovieId($movie_id);
    }

    public function createMovie($movie)
    {
        return $this->movieRepository::create($movie);
    }

    public function delete($id)
    {
        if (!empty($id)) {
            if (is_array($id)){
                return $this->movieRepository::deleteAllElements($id);
            }
            return $this->movieRepository::delete($id);
        }
        return response()->json(['message' => 'please select a movie.','color' => 'error'], 422);
    }
}

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
}

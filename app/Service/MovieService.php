<?php

namespace App\Service;

use App\Repository\MovieRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class MovieService
{
    // Attributes
    private MovieRepository $movieRepository;

    // Methods
    public function __construct( MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function getMovies(): Collection
    {
       return $this->movieRepository::all();
    }

    public function getOneMovie($movie_id): Model | null
    {
        return $this->movieRepository::findByMovieId($movie_id);
    }

    public function createMovie($movie): Model | null
    {
        return $this->movieRepository::create($movie);
    }

    public function delete($id): array | int | JsonResponse
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

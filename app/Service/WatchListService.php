<?php

namespace App\Service;

use App\Repository\WatchListRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class WatchListService
{
    // Attributes
    private WatchListRepository $watchListRepository;

    // Methods
    public function __construct(WatchListRepository $movieRepository)
    {
        $this->watchListRepository = $movieRepository;
    }

    public function getItems(): Collection
    {
       return $this->watchListRepository::all();
    }

    public function getOneItem($movie_id): Model | null
    {
        return $this->watchListRepository::findByItemId($movie_id);
    }

    public function createItemList($movie): Model | null
    {
        return $this->watchListRepository::create($movie);
    }

    public function delete($id): array | int | JsonResponse
    {
        if (!empty($id)) {
            if (is_array($id)){
                return $this->watchListRepository::deleteAllElements($id);
            }
            return $this->watchListRepository::delete($id);
        }
        return response()->json(['message' => 'please select a movie.','color' => 'error'], 422);
    }
}

<?php

namespace App\Repository;

use App\Models\Movie;

class MovieRepository extends AbstractRepository
{
    protected static $model = Movie::class;

    public static function findByMovieId(int $movie_id)
    {
        return self::loadModel()::query()->where(['movie_id' => $movie_id])->first();
    }

    public static function deleteAllElements(array $ids): array
    {

            self::loadModel()::query()->whereIn('id', $ids)->delete();
        return ["message" => "deletado com sucesso"];
    }
}

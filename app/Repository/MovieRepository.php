<?php

namespace App\Repository;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;

class MovieRepository extends AbstractRepository
{
    protected static $model = Movie::class;

    public static function findByMovieId(int $movie_id): Model | null
    {
        return self::loadModel()::query()->where(['movie_id' => $movie_id])->first();
    }

    public static function deleteAllElements(array $ids): array
    {

            self::loadModel()::query()->whereIn('id', $ids)->delete();
        return ["message" => "deletado com sucesso"];
    }
}

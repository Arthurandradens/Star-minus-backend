<?php

namespace App\Repository;

use App\Models\WatchList;
use Illuminate\Database\Eloquent\Model;

class WatchListRepository extends AbstractRepository
{
    protected static $model = WatchList::class;

    public static function findByItemId(int $movie_id): Model | null
    {
        return self::loadModel()::query()->where(['movie_id' => $movie_id])->first();
    }

    public static function deleteAllElements(array $ids): array
    {

            self::loadModel()::query()->whereIn('id', $ids)->delete();
        return ["message" => "deletado com sucesso"];
    }
}

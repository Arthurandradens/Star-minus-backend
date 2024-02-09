<?php

namespace App\Repository;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

abstract class AbstractRepository implements RepositoryInterface
{
    protected static $model;

    public static function loadModel(): Model
    {
        // TODO: inicialiaza a minha model
        return app(static::$model);
    }
    public static function all(): Collection
    {
        return  self::loadModel()::all();
    }

    public static function allUserItems(): Collection
    {
        return  self::loadModel()::where('user_id', Auth::user()->id)->get();
    }

    public static function find(int $id): Model|null
    {
        return self::loadModel()::query()->find($id);
    }

    public static function create(array $attributes = []): Model|null
    {
        return self::loadModel()::query()->create($attributes);
    }

    public static function delete(int $id): int
    {
        return self::loadModel()::query()->where(['movie_id' => $id])->delete();
    }

    public static function update(int $id, array $attributes): int
    {
        return self::loadModel()::query()->where(['id' => $id])->update($attributes);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WatchList extends Model
{
    use HasFactory;

    protected $table = "watchlist";
    protected $fillable = [
        'name',
        'url',
        'type',
        'movie_id',
        'user_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

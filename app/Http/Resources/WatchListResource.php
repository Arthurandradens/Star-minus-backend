<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WatchListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

                'id' => (string)$this->id,
                'attributes' => [
                    'name' => $this->name,
                    'url' => $this->url,
                    'type' => $this->type,
                    'movie_id' => $this->movie_id,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ],
//                'relationships' => [
//                    'id' => (string)$this->user->id,
//                    'user name' => $this->user->name,
//                    'email' => $this->user->email,
//
//                ]

        ];
    }
}

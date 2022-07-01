<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'watched'     => $this->users->first() ? 1 : 0,
            'id'          => $this->id,
            'title'       => $this->title,
            'youtube_uid' => $this->youtube_uid,
            'thumbnail'   => $this->hasMedia('thumbnail') ? $this->getFirstMediaUrl('thumbnail') : null,
        ];
    }
}

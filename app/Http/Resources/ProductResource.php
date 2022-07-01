<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'price' => $this->price,
            'image' => count($this->images) ? asset('storage/product/' . $this->images->first()->image) : asset('default/default_image.png'),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category->name,
            'price' => $this->price,
            'description' => $this->description,
            'images' => ImageResource::collection($this->images),
            'total_rate' => $this->rates->count() ? ($this->rates->sum('pivot.rate') / $this->rates->count()) : 5,
            'ratings' => RateResource::collection($this->rates),
        ];
    }
}

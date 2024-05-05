<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
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
            'user' => $this->name,
            'image_user' => $this->image,
            'rate' => $this->pivot->rate,
            'notes' => $this->pivot->notes,
            'date' => date("Y-m-d ", strtotime($this->created_at)),
        ];
    }
}

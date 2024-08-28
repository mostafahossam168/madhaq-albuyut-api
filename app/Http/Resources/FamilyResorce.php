<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyResorce extends JsonResource
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
            'status' => $this->status ? 'مفعل' : 'غير  مفعل',
            'image' => url('') . "/" . $this->image,
            'categories' => $this->categories,
            'products' => ProductResource::collection(Product::whereIn('category_id', $this->categories->pluck('id')->toArray())->get()),
        ];
    }
}

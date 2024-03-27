<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Nette\Utils\ObjectHelpers;

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
            'category_id' => $this->category_id,
            'slug' => $this->slug,
            'title' => $this->title,
            'price' => $this->price,
            'stock' => $this->stock,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'variant' => json_decode($this->variant, true),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'gallery' => GalleryResource::collection($this->whenLoaded('gallery')),
        ];
    }
}

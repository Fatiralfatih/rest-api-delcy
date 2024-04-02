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
            'slug' => $this->slug,
            'title' => $this->title,
            'category' => $this->category,
            'price' => $this->price,
            'stock' => $this->stock,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'variant' => json_decode($this->variant, true),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'gallery' => GalleryResource::collection($this->whenLoaded('gallery')),
        ];
    }
}

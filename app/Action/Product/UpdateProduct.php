<?php

namespace App\Action\Product;

use Illuminate\Support\Str;

class UpdateProduct
{
    public function execute($product, $request)
    {
        return $product->update([
            'slug' => str::slug($request->title),
            'title' => $request->title,
            'category' => $request->category,
            'price' => $request->price,
            'status' => $request->status,
            'stock' => $request->stock,
            'variant' => json_encode($request->variant),
            'thumbnail' => $request->thumbnail,
            'description' => $request->description,
        ]);
    }
}
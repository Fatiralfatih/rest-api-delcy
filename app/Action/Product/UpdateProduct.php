<?php

namespace App\Action\Product;

use Illuminate\Support\Str;

class UpdateProduct
{
    public function execute($product, $request)
    {
        return $product->update([
            'category_id' => $request->category_id,
            'slug' => str::slug($request->title),
            'title' => $request->title,
            'price' => $request->price,
            'stock' => $request->stock,
            'thumbnail' => $request->thumbnail,
            'description' => $request->description,
        ]);
    }
}
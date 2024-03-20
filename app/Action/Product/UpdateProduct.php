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
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'description' => $request->description,
        ]);
    }
}
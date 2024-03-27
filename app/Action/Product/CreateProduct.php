<?php

namespace App\Action\Product;

use App\Models\Product;
use Illuminate\Support\Str;

class CreateProduct
{
    function execute($request)
    {
        $product = Product::create([
            'slug' => str::slug($request->title, '-'),
            'title' => $request->title,
            'price' => $request->price,
            'stock' => $request->stock,
            'variant' => json_encode($request->variant),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'thumbnail' => $request->thumbnail,
        ]);

        return $product;
    }
}
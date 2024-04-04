<?php

namespace App\Action\Product;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Support\Str;


class CreateProduct
{
    function execute(StoreProductRequest $request)
    {
        $product = Product::create([
            'slug' => str::slug($request->title, '-'),
            'title' => $request->title,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status,
            'variant' => $request->variant,
            'category' => $request->category,
            'description' => $request->description,
            'thumbnail' => $request->file('thumbnail')->store('image/product', 'public'),
        ]);

        return $product;
    }
}
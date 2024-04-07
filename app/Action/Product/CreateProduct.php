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
            'category_id' => $request->category_id,
            'title' => $request->title,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status,
            'variant' => json_encode($request->variant),
            'description' => $request->description,
            'thumbnail' => $request->file('thumbnail')?->store('image/product', 'public'),
        ]);

        return $product;
    }
}
<?php

namespace App\Action\Product;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateProduct
{
    public function execute($product, $request)
    {
        $product->update([
            'slug' => str::slug($request->title, '-'),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status,
            'variant' => $request->variant,
            'description' => $request->description,
        ]);
    }
}
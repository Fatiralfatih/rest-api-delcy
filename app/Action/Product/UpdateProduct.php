<?php

namespace App\Action\Product;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateProduct
{
    public function execute($product, $request)
    {
        $slug = '';
        $title = '';
        if ($request->title) {
            $title .= $request->title;
            $slug .= str::slug($request->title, '-');
        } else {
            $title .= $product->title;
            $slug .= str::slug($product->slug, '-');
        }

        $product->update([
            'category_id' => $request->category_id,
            'slug' => $slug,
            'title' => $title,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status,
            'variant' => json_encode($request->variant),
            'description' => $request->description,
        ]);
    }
}
<?php

namespace App\Action\Product;

use App\Models\Product;

class GetProducts
{
    function execute()
    {
        $product = Product::select(['id', 'category_id', 'slug', 'title', 'price', 'stock', 'description', 'thumbnail'])->with(['category'])->get();

        return $product;
    }
}
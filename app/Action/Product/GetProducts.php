<?php

namespace App\Action\Product;

use App\Models\Product;

class GetProducts
{
    function execute()
    {
        $product = Product::select(['id', 'slug', 'title', 'price', 'stock', 'category', 'description', 'thumbnail'])->get();

        return $product;
    }
}
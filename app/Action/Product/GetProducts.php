<?php

namespace App\Action\Product;

use App\Models\Product;

class GetProducts
{
    function execute()
    {
        $product = Product::with(['category', 'gallery'])->get();

        return $product;
    }
}
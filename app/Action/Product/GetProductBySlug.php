<?php

namespace App\Action\Product;

use App\Models\Product;

class GetProductBySlug
{
    function execute($slug)
    {
        $product = Product::where('slug', $slug)->with(['category'])->firstOrFail();

        return $product;
    }
}
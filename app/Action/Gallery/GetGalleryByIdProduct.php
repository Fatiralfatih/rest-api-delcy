<?php

namespace App\Action\Gallery;

use App\Models\Gallery;

class GetGalleryByIdProduct
{
    function execute($productId)
    {
        $gallery = Gallery::select(['id', 'product_id', 'image'])
            ->where('product_id', $productId)
            ->with(['product:id,slug,title'])
            ->firstOrFail();

        return $gallery;
    }
}
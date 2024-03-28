<?php

namespace App\Action\Gallery;

use App\Models\Gallery;

class GetGalleryById
{
    function execute($idGallery)
    {
        $gallery = Gallery::where('id', $idGallery)->with(['product'])->firstOrFail();

        return $gallery;
    }
}
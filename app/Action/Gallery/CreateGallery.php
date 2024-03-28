<?php

namespace App\Action\Gallery;


class CreateGallery
{
    function execute($gallery, $request)
    {
        return $gallery->product()->create([
            'image' => $request->image,
        ]);
    }
}
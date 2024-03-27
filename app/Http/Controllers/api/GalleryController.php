<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    function index($id)
    {
        $gallery = Gallery::select(['id', 'product_id', 'image'])
            ->where('id', $id)
            ->with(['product:id,slug,title'])
            ->get();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'get data gallery by id product',
            'data' => $gallery,
        ]);
    }
}

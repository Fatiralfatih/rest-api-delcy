<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    function index($id)
    {
        try {

            $gallery = Gallery::select(['id', 'product_id', 'image'])
                ->where('product_id', $id)
                ->with(['product:id,slug,title'])
                ->get();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'get data gallery by id product',
                'data' => $gallery,
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'code' => 400,
                'status' => 'failed',
                'message' => $th,
                'data' => null,
            ], 400);
        }
    }
}

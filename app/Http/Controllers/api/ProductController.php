<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index()
    {
        try {
            $product = Product::select(['id', 'slug', 'title', 'price', 'stock', 'category', 'description', 'thumbnail'])->get();

            $data = ProductResource::collection($product);

            $response = [
                'code' => 200,
                'status' => 'success',
                'message' => 'fetch data products',
                'data' => $data,
            ];
            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Unable to communicate with database',
                'data' => null,
            ], 404);
        }
    }
}

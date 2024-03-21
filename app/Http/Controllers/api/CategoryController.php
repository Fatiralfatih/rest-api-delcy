<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index()
    {
        try {
            $category = CategoryResource::collection(Category::all());

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'get data catagery',
                'data' => $category,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'status' => 'failed',
                'message' => 'request failed get data categories',
                'data' => null,
            ], 400);
        }
    }
}

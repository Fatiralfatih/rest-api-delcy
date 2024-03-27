<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function successResponse($messages, $data, $code = 200)
    {
        $response = [
            'status' => 'success',
            'messages' => $messages,
            'data' => $data ? $data : null,
        ];

        return response()->json($response, $code);
    }

    function index()
    {
        $response = CategoryResource::collection(Category::all());

        return $this->successResponse('get categories', $response, 200);
    }

    function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
        ]);

        return $this->successResponse('create category', new CategoryResource($category), 201);
    }
}

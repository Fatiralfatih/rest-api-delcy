<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{

    function index(): JsonResponse
    {
        $response = CategoryResource::collection(Category::all());

        return $this->successResponse('get categories', $response, 200);
    }

    function store(CategoryRequest $request): JsonResponse
    {
        $category = Category::create([
            'name' => $request->name,
        ]);

        return $this->successResponse('create category', new CategoryResource($category), 201);
    }
}

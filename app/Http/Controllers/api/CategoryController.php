<?php

namespace App\Http\Controllers\api;

use App\Action\Category\CreateCategory;
use App\Action\Category\GetCategories;
use App\Action\Category\GetCategoryByName;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    function index(): JsonResponse
    {
        $categories = app(GetCategories::class)->execute();

        $response = CategoryResource::collection($categories);

        return $this->successResponse('get categories', $response);
    }

    function store(CategoryRequest $request): JsonResponse
    {
        $category = app(CreateCategory::class)->execute($request);

        $response = new CategoryResource($category);

        return $this->successResponse('create category', $response, 201);
    }

    function show(string $nameCategory): JsonResponse
    {
        $category = app(GetCategoryByName::class)->execute($nameCategory);

        $response = new CategoryResource($category);

        return $this->successResponse('get category by name', $response);
    }

}

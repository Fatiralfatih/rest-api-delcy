<?php

namespace App\Http\Controllers\api;

use App\Action\Product\CreateProduct;
use App\Action\Product\GetProductBySlug;
use App\Action\Product\GetProducts;
use App\Action\Product\UpdateProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function index(): JsonResponse
    {
        $product = app(GetProducts::class)->execute();

        $response = ProductResource::collection($product->all());

        return $this->successResponse('get products', $response, 200);
    }

    function show(string $slug): JsonResponse
    {
        $product = app(GetProductBySlug::class)->execute($slug);

        $response = new ProductResource($product);

        return $this->successResponse('get product by slug', $response, 200);
    }

    function store(StoreProductRequest $request): JsonResponse
    {
        $product = app(CreateProduct::class)->execute($request);

        $response = new ProductResource($product);

        return $this->successResponse('create product', $response, 201);
    }

    function update(string $slug, UpdateProductRequest $request): JsonResponse
    {
        $product = app(GetProductBySlug::class)->execute($slug);

        app(UpdateProduct::class)->execute($product, $request);

        return $this->successResponse('update product by slug', new ProductResource($product), 200);
    }

    function delete(string $slug): JsonResponse
    {
        $product = app(GetProductBySlug::class)->execute($slug);

        Storage::delete('public/' . $product->thumbnail);

        $product->delete();

        return $this->successResponse('delete product by slug', new ProductResource($product), 200);
    }

}

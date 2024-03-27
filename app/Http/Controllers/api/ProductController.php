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

class ProductController extends Controller
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
        $product = app(GetProducts::class)->execute();

        $response = ProductResource::collection($product);

        return $this->successResponse('get products', $response);
    }

    function show($slug)
    {
        $product = app(GetProductBySlug::class)->execute($slug);

        $response = new ProductResource($product);

        return $this->successResponse('get product by slug', $response);
    }

    function store(StoreProductRequest $request)
    {
        $product = app(CreateProduct::class)->execute($request);

        $response = new ProductResource($product);

        return $this->successResponse('create product', $response);
    }

    function update($slug, UpdateProductRequest $request)
    {
        $product = app(GetProductBySlug::class)->execute($slug);

        app(UpdateProduct::class)->execute($product, $request);

        return $this->successResponse('update product', new ProductResource($product), 200);
    }

    function delete($slug)
    {
        $product = app(GetProductBySlug::class)->execute($slug);

        $product->delete();

        return $this->successResponse('delete product by slug', new ProductResource($product));
    }

}

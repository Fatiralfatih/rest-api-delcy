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
    function index()
    {
        try {
            $product = app(GetProducts::class)->execute();

            $data = ProductResource::collection($product);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'get data products',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 404,
                'status' => 'failed',
                'message' => 'request failed get data product',
                'data' => null,
            ], 404);
        }
    }

    function show($slug)
    {
        try {
            $product = app(GetProductBySlug::class)->execute($slug);

            $data = new ProductResource($product);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'get data product by slug',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'status' => 'failed',
                'message' => 'missing parameter slug product',
                'data' => null,
            ], 400);
        }
    }

    function create(StoreProductRequest $request)
    {
        $product = app(CreateProduct::class)->execute($request);

        return response()->json([
            'code' => 201,
            'status' => 'success',
            'message' => 'create data product',
            'data' => $product,
        ], 201);
    }

    function update($slug, UpdateProductRequest $request)
    {
        try {
            $product = app(GetProductBySlug::class)->execute($slug);

            app(UpdateProduct::class)->execute($product, $request);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'update data product',
                'data' => $product,
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                'code' => 400,
                'status' => 'failed',
                'message' => 'missing parameter slug product',
                'data' => null,
            ], 400);
        }
    }

    function delete($slug)
    {
        try {
            $product = app(GetProductBySlug::class)->execute($slug);

            $product->delete();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'delete data product by slug',
                'data' => $product
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'status' => 'failed',
                'message' => 'missing parameter slug product',
                'data' => null,
            ]);
        }
    }

}

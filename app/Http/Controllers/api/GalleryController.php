<?php

namespace App\Http\Controllers\api;

use App\Action\Gallery\GetGalleryById;
use App\Action\Gallery\GetGalleryByIdProduct;
use App\Action\Product\GetProductBySlug;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Http\Resources\GalleryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{

    function show(int $productId): JsonResponse
    {
        $gallery = app(GetGalleryByIdProduct::class)->execute($productId);

        return $this->successResponse('get gallery by id product', GalleryResource::collection($gallery), 200);
    }

    function store(string $slugProduct, GalleryRequest $request): JsonResponse
    {
        $product = app(GetProductBySlug::class)->execute($slugProduct);

        if (is_array($request->file('image'))) {
            $uploadImages = [];
            $product = app(GetProductBySlug::class)->execute($slugProduct);
            foreach ($request->file('image') as $image) {
                $path = $image->store('image/product', 'public');
                $product->gallery()->create([
                    'image' => $path
                ]);
                $uploadImages[] = $path;
            }
            return response()->json([
                'status' => 'success',
                'messages' => 'create many gallery by id product',
                'data' => [
                    'product_id' => $product->id,
                    'images' => $uploadImages,
                ],
            ]);
        } else {
            $image = $request->file('image');
            $response = $product->gallery()->create([
                'image' => $image->store('image/product', 'public'),
            ]);
            return $this->successResponse('create gallery by id product', new GalleryResource($response), 200);
        }
    }

    function delete(int $idGallery): JsonResponse
    {
        $gallery = app(GetGalleryById::class)->execute($idGallery);

        // delete image from storage
        Storage::delete('public/' . $gallery->image);

        // and go delete image in database
        $gallery->delete();

        return $this->successResponse('delete gallery by id', new GalleryResource($gallery), 200);
    }
}

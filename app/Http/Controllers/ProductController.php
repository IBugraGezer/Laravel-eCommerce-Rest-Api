<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response(ProductResource::collection(Product::all()), 200);
        } catch(\Exception $e) {
            return response(config('responses.as_array.error'),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $request->validated();

        $images = json_decode($request->images, true);

        DB::beginTransaction();
        try {
            $product = new Product;
            $product->fill($request->all());
            $product->generateProductSerialNumber();
            $product->save();

            foreach($images as $imageData) {
                $image = new ProductImage;
                $image->product_id = $product->id;
                $image->path = $imageData['path'];
                $image->place_number = $imageData['place_number'];
                $image->is_cover = $imageData['is_cover'];
                $image->save();
            }

            DB::commit();
            return response(new ProductResource($product), 200);
        } catch(\Exception $e) {
            DB::rollBack();
            return response(/*config('responses.as_array.error')*/ $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch(\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }

        return response(new ProductResource($product), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $request->validated();

        try {
            $product = Product::findOrFail($id);
        } catch(\Exception $e) {
            return response(config('responses.as_array.not_found', 404));
        }
        try {
            $product->update($request);
            return response(new ProductResource($product),200);
        } catch(\Exception $e) {
            return response(config('responses.as_array.error'), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth('sanctum')->user()->cannot('delete', Product::class))
            return response(config('responses.as_array.unauthorized'), 403);

        try {
            $product = Product::findOrFail($id);
        } catch(\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }

        $deleteCount = Product::destroy($id);

        return response(["deleted" => $deleteCount], 200);
    }
}

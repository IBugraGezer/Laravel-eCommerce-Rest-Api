<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth_check')->except(['index', 'show']);
    }

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
        if(auth('sanctum')->user()->cannot('create', Product::class))
            return response(config('responses.as_array.unauthorized'), 403);

        $request->validated();

        try {
            $product = new Product;
            $product->fill($request->all());
            $product->generateProductSerialNumber();
            $product->save();
            return response(new ProductResource($product), 200);
        } catch(\Exception $e) {
            return response(config('responses.as_array.error'), 500);
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
        if(auth('sanctum')->user()->cannot('update', Product::class))
            return response(config('responses.as_array.unauthorized'), 403);

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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Http\Request;
use App\Http\Resources\BrandResource;
use App\Models\Brand;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth_check')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response(BrandResource::collection(Brand::all()), 200);
        } catch(\Exception $e) {
            return response(config('responses.as_array.error'),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        if (auth('sanctum')->user()->cannot('create', Brand::class)) {
            return response(config('responses.as_array.unauthorized'), 403);
        }

        $data = $request->validated();

        try {
            $brand = new BrandResource(Brand::create($data));
            return response($brand, 200);
        } catch (\Exception $e) {
            return response(config('responses.as_array.error'), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $brand = Brand::findOrFail($id);
        } catch (\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }
        return response(new BrandResource($brand), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        if(auth('sanctum')->user()->cannot('update', Brand::class)) {
            return response(config('responses.as_array.unauthorized'), 403);
        }

        $data = $request->validated();

        try {
            $brand = Brand::findOrFail($id);
        } catch (\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }
        try {
            $brand->update($data);
            return response(new BrandResource($brand), 200);
        } catch (\Exception $e) {
            return response(config('responses.as_array.error'), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth('sanctum')->user()->cannot('update', Brand::class)) {
            return response(config('responses.as_array.unauthorized'), 403);
        }

        try {
            $brand = Brand::findOrFail($id);
        } catch (\Exception $e) {
            return response(config('responses.as_array.snot_found'), 404);
        }

        $deleteCount = Brand::destroy($id);

        return response(["deleted" => $deleteCount], 200);
    }
}

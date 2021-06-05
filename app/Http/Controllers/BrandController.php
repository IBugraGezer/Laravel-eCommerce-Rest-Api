<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\BrandResource;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(BrandResource::collection(Brand::all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth('sanctum')->check()
            || auth('sanctum')->user()->cannot('create', Brand::class)) {
            return response(["message" => config('responses.unauthorized')], 403);
        }

        $data = $request->validate([
            'name' => 'required|string|min:2|max:50|unique:brands,name',
            'active' => 'numeric|min:0|max:1'
        ]);
        try {
            $brand = new BrandResource(Brand::create($data));
            return response(new BrandResource($brand), 200);
        } catch (\Exception $e) {
            return response(["message" => config('responses.error')], 500);
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
            return response(["message" => config('responses.not_found')], 404);
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
    public function update(Request $request, $id)
    {
        if(!auth('sanctum')->check()
            || auth('sanctum')->user()->cannot('update', Brand::class)) {
            return response(["message" => config('responses.unauthorized')], 403);
        }

        $data = $request->validate([
            'name' => 'required|string|min:2|max:50|unique:brands,name',
            'active' => 'required|numeric|min:0|max:1'
        ]);

        try {
            $brand = Brand::findOrFail($id);
        } catch (\Exception $e) {
            return response(["message" => config('responses.not_found')], 404);
        }
        try {
            $brand->update($data);
            return response(new BrandResource($brand), 200);
        } catch (\Exception $e) {
            return response(["message" => config('responses.error')], 500);
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
        if (!auth('sanctum')->check()
            || auth('sanctum')->user()->cannot('update', Brand::class)) {
            return response(["message" => config('responses.unauthorized')], 403);
        }

        try {
            $brand = Brand::findOrFail($id);
        } catch (\Exception $e) {
            return response(["message" => config('responses.not_found')], 404);
        }

        $deleteCount = Brand::destroy($id);

        return response(["deleted" => $deleteCount], 200);
    }
}

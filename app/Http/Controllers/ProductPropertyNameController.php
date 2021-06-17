<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPropertyNameStoreRequest;
use App\Http\Requests\ProductPropertyNameUpdateRequest;
use App\Http\Resources\ProductPropertyNameResource;
use App\Models\ProductPropertyName;
use Illuminate\Http\Request;

class ProductPropertyNameController extends Controller
{
    public function __construct()
    {
        $this->middleware('check_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(ProductPropertyNameResource::collection(ProductPropertyName::all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPropertyNameStoreRequest $request)
    {
        $data = $request->validated();

        try {
            $productProperty = ProductPropertyName::create($data);
            return response(new ProductPropertyNameResource($productProperty), 200);
        } catch (\Exception $e) {
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
            $productPropertyName = ProductPropertyName::findOrFail($id);
            return response(new ProductPropertyNameResource($productPropertyName), 200);
        } catch (\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductPropertyNameUpdateRequest $request, $id)
    {
        $data = $request->validated();

        try {
            $productPropertyName = ProductPropertyName::findOrFail($data);
        } catch (\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }

        try {
            $productPropertyName->update($data);
            return response(new ProductPropertyName($productPropertyName), 200);
        } catch (\Exception $e) {
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
        try {
            $productPropertyName = ProductPropertyName::findOrFail($id);
        } catch (\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }

        $deleteCount = ProductPropertyName::destroy($id);

        return response(["deleted" => $deleteCount], 200);
    }
}

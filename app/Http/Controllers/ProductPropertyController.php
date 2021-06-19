<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPropertyStoreRequest;
use App\Http\Requests\ProductPropertyUpdateRequest;
use App\Http\Resources\ProductPropertyResource;
use App\Http\Resources\ProductPropertyValueResource;
use App\Models\Product;
use App\Models\ProductProperty;
use Illuminate\Http\Request;

class ProductPropertyController extends Controller
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
        return response(ProductPropertyResource::collection(ProductProperty::all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPropertyStoreRequest $request)
    {
        $data = $request->validated();

        try {
            $productProperty = ProductProperty::create($data);
            return response(new ProductPropertyResource($productProperty), 200);
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
            $productProperty = ProductProperty::findOrFail($id);
        } catch (\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }

        return response(new ProductPropertyResource($productProperty), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductPropertyUpdateRequest $request, $id)
    {
        $data = $request->validated();

        try {
            $productProperty = ProductProperty::findOrFail($id);
        } catch (\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }

        try {
            $productProperty->property_value_id = $data['property_value_id'];
            $productProperty->save();
        } catch (\Exception $e) {
            return response(config('responses.as_array.error'), 500);
        }

        return response(new ProductPropertyResource($productProperty), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

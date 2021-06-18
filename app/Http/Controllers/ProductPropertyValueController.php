<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPropertyValueStoreRequest;
use App\Http\Requests\ProductPropertyValueUpdateRequest;
use App\Http\Resources\ProductPropertyValueResource;
use App\Models\ProductPropertyValue;
use Illuminate\Http\Request;

class ProductPropertyValueController extends Controller
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
        return response(ProductPropertyValueResource::collection(ProductPropertyValue::all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPropertyValueStoreRequest $request)
    {
        $data = $request->validated();

        try {
            $productPropertyValue = ProductPropertyValue::create($data);
            return response(new ProductPropertyValueResource($productPropertyValue), 200);
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
            $productPropertyValue = ProductPropertyValue::findOrFail($id);
            return response(new ProductPropertyValueResource($productPropertyValue), 200);
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
    public function update(ProductPropertyValueUpdateRequest $request, $id)
    {
        $data = $request->validated();

        try {
            $productPropertyValue = ProductPropertyValue::findOrFail($id);
        } catch (\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }

        try {
            $productPropertyValue->value = $data['value'];
            $productPropertyValue->save();
            return response(new ProductPropertyValueResource($productPropertyValue), 200);
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
            $productPropertyValue = ProductPropertyValue::findOrFail($id);
        } catch (\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }

        $deleteCount = $productPropertyValue->delete();

        return response(["deleted" => $deleteCount], 200);
    }
}

<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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

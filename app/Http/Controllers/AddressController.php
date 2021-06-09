<?php

namespace App\Http\Controllers;

use App\Helper\AuthHelper;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_check')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response(AddressResource::collection(Address::all()), 200);
        } catch (\Exception $e) {
            return response(config('responses.as_array.error'), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        $request->validated();

        try {
            $address = new Address;
            $address->fill($request->all());
            $address->user_id = auth('sanctum')->user()->id;
            $address->save();

            return response(new AddressResource($address), 200);
        } catch(\Exception $e) {
            return response(config('repsonses.as_array.error'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request, $id)
    {
        try {
            $address = Address::findOrFail($id);
        } catch(\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }

        if(auth('sanctum')->user()->cannot('update', $address))
            return response(config('responses.as_array.unauthorized'), 403);

        $request->validated();

        try {
            $address->update($request);
            return response(new AddressResource($address), 200);
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
            $address = Address::findOrFail($id);
        } catch (\Exception $e) {
            return response(config('responses.as_array.not_found'), 404);
        }

        if(auth('sanctum')->user()->cannot('delete', $address))
            return response(config('responses.as_array.unauthorized'), 403);

        $deleteCount = Address::destroy($id);

        return response(["deleted" => $deleteCount], 200);
    }
}

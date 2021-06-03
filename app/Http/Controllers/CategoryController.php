<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_check', ['except' => ['index','show']]);
        $this->middleware('auth:sanctum', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response(CategoryResource::collection(Category::all()),200);
        } catch (\Exception $e) {
            return response(["message" => $e->getMessage()],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:2|max:40|unique:categories,name',
            'active' => 'numeric|min:0|max:1'
        ]);
        try {
            $category =new CategoryResource(Category::create($data));
            return response($category, 200);
        } catch (\Exception $e) {
            return response(["message" => config('responses.error'), 500]);
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
            return response(new CategoryResource(Category::findOrFail($id)), 200);
        } catch (\Exception $e) {
            return response(["message" => config('responses.error')], 500);
        }

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
        $data = $request->validate([
            'name' => 'string|min:2|max:40|unique:categories,name',
            'active' => 'numeric|min:0|max:1'
        ]);
        try {
            $category = Category::findOrFail($id);
            $category->update($data);
            return response(new CategoryResource($category), 200);
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
        try {
            return response(Category::destroy($id), 200);
        } catch (\Exception $e) {
            return response(["message" => config('responses.error')], 500);
        }
    }
}

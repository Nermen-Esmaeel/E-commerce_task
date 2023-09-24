<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

  //fetch all categories
    public function index(){

        $categories = Category::all();
        return response()->json([
            'message' => 'Success',
            'user' => CategoryResource::collection($categories),
            'status' => 200,
        ]);
    }


    //store category
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
        ]);

        $category = Category::create([

            'name' => $request->name,
        ]);


        return response()->json([
            'message' => 'Category created successfully',
            'user' => new CategoryResource($category),
            'status' => 201,
        ]);
    }



    //update  category
    public function update(Request $request, $id)
    {
        $input = $request->input();

        $category = Category::find($id);
        if ($category) {
            $category->update($input);


            return response()->json([
                'message' => 'Category updated successfully',
                'user' => new CategoryResource($category),
                'status' => 201,
            ]);
        }

        return response()->json([
            'message' => 'Invalid ID!',
            'status' => 404,
        ]);
    }


    //delete category
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json([
                'message' => 'category deleted successfuly!',
                'status' => 200,
            ]);
        }else{
            return response()->json([
                'message' => 'Invalid ID!',
                'status' => 404,
            ]);
        }



    }
}

<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategory;
use App\Http\Resources\Category\CategoryResource;


class CategoryController extends Controller
{
    use ApiResponseTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

  //fetch all categories
    public function index(){

        try {
            $categories = Category::all();
            return $this->apiResponse(CategoryResource::collection($categories), 'Success' , 200);

        }
        catch (\Throwable $th) {
                return $this->errorResponse($th);
            }
    }


    //store category
    public function store(StoreCategory $request)
    {
        try {

            $category = Category::create([

                'name' => $request->name,
            ]);

            return $this->apiResponse(new CategoryResource($category), 'Category created successfully' , 201);

        }catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }



    //update  category
    public function update(Request $request, $id)
    {
        try {

            $category = Category::find($id);
            if ($category) {
                $category->update($request->input());
                return $this->apiResponse(new CategoryResource($category), 'Category updated successfully' , 200);
            }
            return $this->notFoundResponse();

        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }


    //delete category
    public function destroy($id)
    {
        try {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return $this->apiResponse( "" ,'Category deleted successfully' , 200);
            }else{
                return $this->notFoundResponse();
            }

    } catch (\Throwable $th) {
        return $this->errorResponse($th);
    }

    }
}

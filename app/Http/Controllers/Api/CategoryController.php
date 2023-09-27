<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\{ApiResponseTrait,UploadsImages};
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategory;
use App\Http\Resources\CategoryResource;


class CategoryController extends Controller
{
    use ApiResponseTrait,UploadsImages;

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

            //upload images
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {
                    //call  UploadImage from trait
                    $path = $this->storeImage( $image ,'category_images' );

                    $category->images()->create([
                        'image_path' => $path,
                    ]);
                }
            }


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

                //handling images
                if ($request->hasFile('images')) {

                    //delete old Images from folder
                    foreach ( $category->images as $image){

                        $this->deleteImage($image->image_path);
                    }

                    foreach ($request->file('images') as $image) {
                        //call  UploadImage from trait
                        $path = $this->storeImage( $image ,'category_images' );

                        $category->images()->update([
                            'image_path' => $path,
                        ]);
                    }
                }//end if => image

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

             //check if category have images
             if ($category->images) {
                //delete old Images from folder
                foreach ( $category->images as $image){

                    $this->deleteImage($image->image_path);
                    $category->images()->delete();
                }
            }

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

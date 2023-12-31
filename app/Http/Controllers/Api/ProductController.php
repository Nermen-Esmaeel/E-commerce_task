<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\{ApiResponseTrait,UploadsImages};
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProduct;
use App\Http\Resources\ProductResource;


class ProductController extends Controller
{
    use ApiResponseTrait,UploadsImages;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

  //fetch all products
    public function index(){

        try {
            $products = Product::all();
            return $this->apiResponse(ProductResource::collection($products), 'Success' , 200);

        }
        catch (\Throwable $th) {
                return $this->errorResponse($th);
            }
    }


    //store products
    public function store(StoreProduct $request)
    {
        try {

            $product = Product::create([

                'name' => $request->name,
            ]);

                //upload images
                if ($request->hasFile('images')) {

                    foreach ($request->file('images') as $image) {
                        //call  UploadImage from trait
                        $path = $this->storeImage( $image ,'product_images' );

                        $product->images()->create([
                            'image_path' => $path,
                        ]);
                    }
                }

            return $this->apiResponse(ProductResource::collection($product), 'Product created successfully' , 201);

        }catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }



    //update  products
    public function update(Request $request, $id)
    {
        try {

            $product = Product::find($id);
            if ($product) {

                $product->update($request->input());

                if ($request->hasFile('images')) {

                    //delete old Images from folder
                    foreach ( $product->images as $image){

                        $this->deleteImage($image->image_path);
                    }

                    foreach ($request->file('images') as $image) {
                        //call  UploadImage from trait
                        $path = $this->storeImage( $image ,'product_images' );

                        $product->images()->update([
                            'image_path' => $path,
                        ]);
                    }
                }//end if => image

             return $this->apiResponse(new ProductResource($product), 'Product updated successfully' , 200);

            }
            return $this->notFoundResponse();

        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
    }


    //delete products
    public function destroy($id)
    {
        try {
        $product = Product::find($id);
        if ($product) {

             //check if category have images
             if ($product->images) {
                //delete old Images from folder
                foreach ( $product->images as $image){

                    $this->deleteImage($image->image_path);
                    $product->images()->delete();
                }
            }
            $product->delete();
            return $this->apiResponse( "" ,'Product deleted successfully' , 200);
            }else{
                return $this->notFoundResponse();
            }

    } catch (\Throwable $th) {
        return $this->errorResponse($th);
    }

    }
}

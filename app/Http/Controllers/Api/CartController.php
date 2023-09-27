<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Requests\Cart\StoreCart;

class CartController extends Controller
{
    use ApiResponseTrait;

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

  //fetch items in cart
  public function index(){

    try {
        $carts = Cart::where('user_id','=',auth('api')->user()->id)->get();
        return $this->apiResponse(CartResource::collection($carts), 'Success' , 200);

    }
    catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
}

    //store cart
    public function store(StoreCart $request)
    {
       $cart=  $this->cartService->addItem($request->product_id,  $request->quantity);
        return $this->apiResponse(new CartResource($cart), 'Product Added To Cart successfully' , 201);
    }


   //delete
    public function destroy(Cart $cart)
    {
        try {
            if ($cart) {
                $cart->delete();
                return $this->apiResponse( "" ,'Product has deleted successfully' , 200);
                }else{
                    return $this->notFoundResponse();
                }

        } catch (\Throwable $th) {
            return $this->errorResponse($th);
        }



    }
}

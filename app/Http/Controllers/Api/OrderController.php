<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{

    use ApiResponseTrait;

    protected $OrderService;

    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }

  //fetch orders
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
     public function confirmOrder(Request $request)
     {
        $order =  $this->OrderService->confirmOrder();
         return $this->apiResponse(new OrderResource($order), 'Product Added To Cart successfully' , 201);
     }


}

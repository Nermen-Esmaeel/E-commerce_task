<?php

namespace App\Services;

use App\Traits\ApiResponseTrait;
use App\Models\{Product,Cart};


class CartService
{

    use ApiResponseTrait;
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function addItem($productId, $quantity)
    {

    try {
        // Retrieve the product from the database
        $product = $this->product->find($productId);
        if ($product) {

                // Add the item to the cart
                $cart = Cart::create([
                    'user_id'  => auth('api')->user()->id,
                    'product_id' =>  $productId,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity ,
                ]);

            return  $cart;

        }

        // Handle if the product doesn't exist
        return $this->notFoundResponse();

    }
        catch (\Throwable $th) {
            return $this->errorResponse($th);
        }
}



}

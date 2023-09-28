<?php

namespace App\Services;

use App\Models\Order;


class OrderService
{

    public function confirmOrder()
    {

        // Create order items
            $order = Order::create([

                'user_id'  => auth('api')->user()->id,
                'name'  => auth('api')->user()->name ,
                'phone' =>auth('api')->user()->phone,
                'address' =>auth('api')->user()->address,
                'date' =>  now(),
                'total_amount' => calculateTotalPrice(),
            ]);
            return  $order;
    }


}



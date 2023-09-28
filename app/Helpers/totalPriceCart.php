<?php

if (!function_exists('calculateTotalPrice')) {

    function calculateTotalPrice()
    {
        $user = auth('api')->user(); // Assuming user authentication is implemented
       $cartItems = $user->cart()->get(); // Assuming the relationship for cart items is defined in the User model
       $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            $totalPrice +=  $cartItem->subtotal;
        }
        return $totalPrice;

    }

}

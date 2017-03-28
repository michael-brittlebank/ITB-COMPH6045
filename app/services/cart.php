<?php

namespace Services;

class Cart {

    public static function updateCart($productId, $quantity){
        $cart = Session::getSessionCart();
        if(!is_array($cart)){
            $cart = array();
        }
        if(isset($cart[$productId])){
            if ($quantity < 1){
                //remove from cart
                unset($cart[$productId]);
            } else {
                //update cart
                $cart[$productId] = $quantity;
            }
        } else {
            //add to cart
            $cart[$productId] = $quantity;
        }
        Session::setSessionCart($cart);
        if(Session::isUserSessionStarted()){
            Users::setUserCart($cart);
        }
        return true;
    }
}
<?php

namespace Services;

class Cart {

    public static function addToCart($productId){
        $cart = Session::getSessionCart();
        if(!is_array($cart)){
            $cart = array();
        }
        if(isset($cart[$productId])){
            $cart[$productId] = $cart[$productId]+1;
        } else {
            $cart[$productId] = 1;
        }
        Session::setSessionCart($cart);
        return true;
    }

    public static function updateCart($productId, $quantity){
        $cart = Session::getSessionCart();
        if(!is_array($cart)){
            $cart = array();
        }
        if(isset($cart[$productId])){
            if ($quantity < 1){
                unset($cart[$productId]);
            } else {
                $cart[$productId] = $quantity;
            }
        }
        Session::setSessionCart($cart);
        return true;
    }
}
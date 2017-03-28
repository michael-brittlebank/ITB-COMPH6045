<?php

namespace Models;

class CartProduct extends Product {

    private $quantity;
    private $totalPrice;

    public function __construct($product, $quantity){
        parent::__construct($product);
        $this->quantity = $quantity;
        $this->totalPrice = $quantity*$product->price;
    }

    public function toString(){
        $parentToString = parent::toString();
        return array_merge($parentToString, array(
            'quantity'=>$this->quantity,
            'totalPrice'=>$this->totalPrice
        ));
    }
}
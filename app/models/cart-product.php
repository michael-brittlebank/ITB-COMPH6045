<?php

namespace Models;

class CartProduct extends Product {

    private $quantity;

    public function __construct($product, $quantity){
        parent::__construct($product);
        $this->quantity = $quantity;
    }

    public function toString(){
        $parentToString = parent::toString();
        return array_merge($parentToString, array(
            'quantity'=>$this->quantity
        ));
    }
}
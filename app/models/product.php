<?php

namespace Models;

class Product {

    private $id;
    private $title;
    private $price;
    private $categories;

    public function __construct($product){
        $this->id = $product->id;
        $this->title = $product->title;
        $this->price = $product->price;
        $this->categories = $product->categories;
    }

    public function toString(){
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'price'=>$this->price,
            'categories'=>$this->categories
        ];
    }
}
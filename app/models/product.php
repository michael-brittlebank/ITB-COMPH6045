<?php

namespace Models;

class Product {

    private $id;
    private $title;
    private $price;
    private $categories;
    private $urlKey;

    public function __construct($product){
        $this->id = $product->id;
        $this->title = $product->title;
        $this->price = $product->price;
        $this->categories = $product->categories;
        $this->urlKey = $product->url_key;
    }

    public function toString(){
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'price'=>$this->price,
            'urlKey'=>$this->urlKey,
            'categories'=>$this->categories
        ];
    }
}
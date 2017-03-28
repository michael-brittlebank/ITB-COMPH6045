<?php

namespace Models;

class Product {

    private $id;
    private $title;
    private $price;
    private $categories;
    private $url;

    public function __construct($product){
        $this->id = (int)$product->id;
        $this->title = $product->title;
        $this->price = (double)$product->price;
        $this->categories = $product->categories;
        $this->url = $product->url_key;
    }
    
    public function getTitle(){
        return $this->title;
    }

    public function toString(){
        return array(
            'id'=>$this->id,
            'title'=>$this->title,
            'price'=>$this->price,
            'url'=>$this->url,
            'categories'=>$this->categories
        );
    }
}
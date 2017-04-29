<?php

namespace Models;

class Product {

    private $id;
    private $title;
    private $price;
    private $categoryId;
    private $categoryName;
    private $url;

    public function __construct($product){
        $this->id = (int)$product->id;
        $this->title = $product->title;
        $this->price = number_format((double)$product->price,2);
        $this->categoryId = $product->category_id;
        $this->categoryName = $product->category_name;
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
            'categoryId'=>$this->categoryId,
            'categoryName'=>$this->categoryName
        );
    }
}
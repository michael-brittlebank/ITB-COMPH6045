<?php

namespace Models;

class Category {

    private $id;
    private $name;

    public function __construct($category){
        $this->id = (int)$category->id;
        $this->name = $category->name;
    }

    public function toString(){
        return array(
            'id'=>$this->id,
            'name'=>$this->name
        );
    }
}
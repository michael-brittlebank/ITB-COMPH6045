<?php

namespace Services;

use \Models\Product;

class Products {
    public static function getProducts($limit,$page){
        $offset = $limit*($page-1);
        $result = Database::getConnection()->get_results("SELECT * FROM product ORDER BY id LIMIT $limit OFFSET $offset");
        if (!is_null($result)){
            var_dump($result);
            die();
            //todo, foreach
            return new Product($result);
        } else {
            return array();
        }
    }

    public static function getProductCount(){
        $result = Database::getConnection()->get_row("SELECT COUNT(*) as count FROM product");
        if (!is_null($result)){
            return (int) $result->count;
        } else {
            return 0;
        }
    }
}
<?php

namespace Services;

use \Models\Product;

class Products {

    public static function getProducts($limit,$page){
        $offset = $limit*($page-1);
        $result = Database::getConnection()->get_results("SELECT * FROM product ORDER BY id LIMIT $limit OFFSET $offset");
        if (!is_null($result)){
            $productList = array();
            foreach ($result as $product){
                array_push($productList, new Product($product));
            }
            return $productList;
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

    public static function createNewProduct($productTitle, $productPrice, $productUrl){
        $productUrl = preg_replace('/[\s-]+/', '-', strtolower($productUrl));;
        $result = Database::getConnection()->query("INSERT INTO product (title, price, url_key) VALUES ('$productTitle',$productPrice, '$productUrl')");
        return $result === 1;
    }

    public static function getProductById($productId){
        $result = Database::getConnection()->get_row("SELECT * FROM product WHERE id = '$productId'");
        if (!is_null($result)){
            return new Product($result);
        } else {
            return null;
        }
    }

    public static function updateProduct($productTitle, $productPrice, $productUrl, $productId){
        $productUrl = preg_replace('/[\s-]+/', '-', strtolower($productUrl));;
        $result = Database::getConnection()->query("UPDATE product SET title = '$productTitle', price=$productPrice, url_key='$productUrl' WHERE id='$productId'");
        return $result === 1;
    }
}
<?php

namespace Services;

use Models\CartProduct;
use \Models\Product;
use \Models\Category;

class Products {

    public static function getProducts($limit,$page){
        $offset = $limit*($page-1);
        $result = Database::getConnection()->get_results("SELECT *, product.id as id, product_category.name as category_name FROM product LEFT JOIN product_category ON product.category_id = product_category.id ORDER BY product.id LIMIT $limit OFFSET $offset");
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

    public static function updateProduct($productTitle, $productPrice, $productUrl, $productCategory, $productId){
        $productUrl = preg_replace('/[\s-]+/', '-', strtolower($productUrl));;
        $result = Database::getConnection()->query("UPDATE product SET title = '$productTitle', price=$productPrice, url_key='$productUrl', category_id='$productCategory' WHERE id='$productId'");
        return $result === 1;
    }
    
    public static function getFeaturedProducts(){
        //get random products for now
        $result = Database::getConnection()->get_results("SELECT * FROM product ORDER BY RAND() LIMIT 4");
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
    
    public static function getProductByUrlKey($urlKey){
        $result = Database::getConnection()->get_row("SELECT * FROM product WHERE url_key = '$urlKey'");
        if (!is_null($result)){
            return new Product($result);
        } else {
            return null;
        }
    }
    
    public static function getProductsInCart($cart){
        if (is_array($cart) && !empty($cart)) {
            $cartToString = implode(',', array_keys($cart));
            $result = Database::getConnection()->get_results("SELECT * FROM product WHERE id IN ($cartToString);");
            if (!is_null($result)) {
                $productList = array();
                foreach ($result as $product) {
                    array_push($productList, new CartProduct($product, $cart[$product->id]));
                }
                return $productList;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    public static function deleteProduct($productId){
        $result = Database::getConnection()->query("DELETE FROM product WHERE id = '$productId'");
        return $result === 1;
    }
    
    public static function getCategories(){
        $result = Database::getConnection()->get_results("SELECT * FROM product_category");
        if (!is_null($result)){
            $categoryList = array();
            foreach ($result as $category){
                array_push($categoryList, new Category($category));
            }
            return $categoryList;
        } else {
            return null;
        }
    }
}
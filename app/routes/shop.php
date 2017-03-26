<?php

//product grid page
$app->get('/shop', \Controllers\Shop::class.':getShopPage')->setName('shop');

//product detail pages
$app->get('/shop/{product}', \Controllers\Shop::class.':getProductPage')->setName('shop-product');
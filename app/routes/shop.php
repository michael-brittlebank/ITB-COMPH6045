<?php

//product grid page
$app->get('/shop', \Controllers\Shop::class.':getShopPage')->setName('shop');

//product detail pages
$app->get('/shop/{page}', \Controllers\Shop::class.':getProductPage');
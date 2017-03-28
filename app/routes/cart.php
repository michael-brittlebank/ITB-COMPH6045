<?php

//user cart page
$app->get('/cart', \Controllers\Cart::class.':getCartPage')->setName('cart');
$app->post('/cart', \Controllers\Cart::class.':submitAddToCart');
$app->put('/cart', \Controllers\Cart::class.':submitUpdateCart');

//checkout page
$app->get('/checkout', \Controllers\Cart::class.':getCheckoutPage')->setName('checkout')->add($userHasCart);
$app->post('/checkout', \Controllers\Cart::class.':submitCheckout');
<?php

//user cart page
$app->get('/checkout/cart', \Controllers\Checkout::class.':getCartPage')->setName('cart');

//checkout page
$app->get('/checkout', \Controllers\Checkout::class.':getCheckoutPage')->setName('checkout');
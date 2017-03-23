<?php

$app->group('/admin', function () use ($app) {
    $app->get('/', \Controllers\Admin::class.':getDashboardPage');

    $app->group('/products', function () use ($app) {
        $app->get('/new', \Controllers\Admin::class.':getNewProductPage');
        $app->get('/edit/:productId', \Controllers\Admin::class.':getEditProductPage');
    });
})->add($isUserAdmin);
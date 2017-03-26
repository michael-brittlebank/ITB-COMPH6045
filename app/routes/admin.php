<?php

$app->group('/admin', function () use ($app) {
    //dashboard
    $app->get('', \Controllers\Admin::class.':getDashboardPage')->setName('admin-dashboard');

    //new product
    $app->get('/create', \Controllers\Admin::class.':getNewProductPage')->setName('admin-new');
    $app->post('/create', \Controllers\Admin::class.':submitNewProduct');

    //edit product
    $app->get('/edit/{productId}', \Controllers\Admin::class.':getEditProductPage')->setName('admin-edit');
})->add($isUserAdmin);
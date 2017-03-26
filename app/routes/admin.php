<?php

$app->group('/admin', function () use ($app) {
    $app->get('', \Controllers\Admin::class.':getDashboardPage')->setName('admin-dashboard');
    $app->get('/new', \Controllers\Admin::class.':getNewProductPage')->setName('admin-new');
    $app->get('/edit/{productId}', \Controllers\Admin::class.':getEditProductPage')->setName('admin-edit');
})->add($isUserAdmin);
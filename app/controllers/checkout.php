<?php

//user cart page
$app->get('/checkout/cart', function ($request, $response, $args) use ($app) {
    $pageName = 'cart';
    $fileName = '/checkout/'.$pageName.'.twig';
    $viewData['metaTitle'] = getenv('META_TITLE_PREFIX').ucwords(str_replace('-',' ',$pageName));
    $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
    $viewData['activePage'] = $pageName;
    return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
})->setName('cart');

//checkout page
$app->get('/checkout', function ($request, $response, $args) use ($app) {
    $pageName = 'checkout';
    $fileName = '/checkout/page.twig';
    $viewData['metaTitle'] = getenv('META_TITLE_PREFIX').ucwords(str_replace('-',' ',$pageName));
    $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
    $viewData['activePage'] = 'shop';
    return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
})->setName('checkout');
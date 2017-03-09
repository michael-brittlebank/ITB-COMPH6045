<?php

//product grid page
$app->get('/shop', function ($request, $response, $args) use ($app) {
    $pageName = 'shop';
    $fileName = '/shop/page.twig';
    $viewData['metaTitle'] = getenv('META_TITLE_PREFIX').ucwords(str_replace('-',' ',$pageName));
    $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
    $viewData['activePage'] = $pageName;
    return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
})->setName('shop');

//product detail pages
$app->get('/shop/{page}', function ($request, $response, $args) use ($app) {
    $pageName = strtolower($args['page']);
    $fileName = '/shop/product.twig';
    $viewData['metaTitle'] = getenv('META_TITLE_PREFIX').ucwords(str_replace('-',' ',$pageName));
    $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
    $viewData['activePage'] = 'shop';
    return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
});
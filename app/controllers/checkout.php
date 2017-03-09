<?php

//user cart page
$app->get('/checkout/cart', function ($request, $response, $args) use ($app) {
    $pageName = 'cart';
    $fileName = '/checkout/'.$pageName.'.twig';
    if(file_exists(join('/',[VIEW_DIRECTORY,$fileName]))){
        $viewData['metaTitle'] = META_TITLE_PREFIX.ucwords(str_replace('-',' ',$pageName));
        $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    } else {
        throw new \Slim\Exception\NotFoundException($request, $response);
    }
});

//checkout page
$app->get('/checkout', function ($request, $response, $args) use ($app) {
    $pageName = strtolower($args['page']);
    $fileName = '/checkout/page.twig';
    $viewData['metaTitle'] = META_TITLE_PREFIX.ucwords(str_replace('-',' ',$pageName));
    $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
    $viewData['activePage'] = 'shop';
    return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
});
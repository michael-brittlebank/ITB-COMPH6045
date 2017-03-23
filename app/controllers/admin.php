<?php

$app->group('/admin', function () use ($app) {
    $app->get('', function ($request, $response) {
        $pageName = 'page';
        $fileName = '/admin/'.$pageName.'.twig';
        $viewData['metaTitle'] = \Services\Util::getMetaTitle('admin');
        $viewData['pageTitle'] = \Services\Util::getPageTitle('admin');
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    });

    $app->group('/products', function () use ($app) {
        $app->get('/new', function ($request, $response) {
            $pageName = 'new';
            $fileName = '/admin/products/'.$pageName.'.twig';
            $viewData['metaTitle'] = \Services\Util::getMetaTitle('admin');
            $viewData['pageTitle'] = \Services\Util::getPageTitle('admin');
            $viewData['activePage'] = $pageName;
            return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
        });
        $app->get('/edit/:productId', function ($request, $response) {
            $pageName = 'edit';
            $fileName = '/admin/products/'.$pageName.'.twig';
            $viewData['metaTitle'] = \Services\Util::getMetaTitle('admin');
            $viewData['pageTitle'] = \Services\Util::getPageTitle('admin');
            $viewData['activePage'] = $pageName;
            return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
        });
    });
})->add($isUserAdmin);
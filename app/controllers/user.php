<?php

//user login page
$app->get('/login', function ($request, $response, $args) use ($app) {
    $pageName = 'login';
    $fileName = '/user/'.$pageName.'.twig';
    if(file_exists(join('/',[VIEW_DIRECTORY,$fileName]))){
        $viewData['metaTitle'] = META_TITLE_PREFIX.ucwords(str_replace('-',' ',$pageName));
        $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    } else {
        throw new \Slim\Exception\NotFoundException($request, $response);
    }
});

//new user page
$app->get('/register', function ($request, $response, $args) use ($app) {
    $pageName = 'register';
    $fileName = '/user/'.$pageName.'.twig';
    if(file_exists(join('/',[VIEW_DIRECTORY,$fileName]))){
        $viewData['metaTitle'] = META_TITLE_PREFIX.ucwords(str_replace('-',' ',$pageName));
        $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    } else {
        throw new \Slim\Exception\NotFoundException($request, $response);
    }
});

//user profile page
$app->get('/profile', function ($request, $response, $args) use ($app) {
    $pageName = 'profile';
    $fileName = '/user/'.$pageName.'.twig';
    if(file_exists(join('/',[VIEW_DIRECTORY,$fileName]))){
        $viewData['metaTitle'] = META_TITLE_PREFIX.ucwords(str_replace('-',' ',$pageName));
        $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
        $viewData['activePage'] = $pageName;
        return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    } else {
        throw new \Slim\Exception\NotFoundException($request, $response);
    }
});
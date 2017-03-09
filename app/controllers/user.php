<?php

//user login page
$app->get('/login', function ($request, $response, $args) use ($app) {
    $pageName = 'login';
    $fileName = '/user/'.$pageName.'.twig';
    $viewData['metaTitle'] = getenv('META_TITLE_PREFIX').ucwords(str_replace('-',' ',$pageName));
    $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
    $viewData['activePage'] = $pageName;
    return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
})->setName('login');

//new user page
$app->get('/register', function ($request, $response, $args) use ($app) {
    $pageName = 'register';
    $fileName = '/user/'.$pageName.'.twig';
    $viewData['metaTitle'] = getenv('META_TITLE_PREFIX').ucwords(str_replace('-',' ',$pageName));
    $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
    $viewData['activePage'] = $pageName;
    return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
})->setName('register');

//user profile page
$app->get('/profile', function ($request, $response, $args) use ($app) {
    $pageName = 'profile';
    $fileName = '/user/'.$pageName.'.twig';
    $viewData['metaTitle'] = getenv('META_TITLE_PREFIX').ucwords(str_replace('-',' ',$pageName));
    $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
    $viewData['activePage'] = $pageName;
    return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
})->setName('profile');

//user logout route
$app->get('/logout', function ($request, $response, $args) use ($app) {
    $pageName = 'logout';
    $fileName = '/user/'.$pageName.'.twig';
    $viewData['metaTitle'] = getenv('META_TITLE_PREFIX').ucwords(str_replace('-',' ',$pageName));
    $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
    $viewData['activePage'] = $pageName;
    return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
})->setName('logout');
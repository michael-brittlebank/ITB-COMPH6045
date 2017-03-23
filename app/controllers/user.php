<?php

//user login page
$app->get('/login', function ($request, $response, $args) use ($app) {
    $pageName = 'login';
    $fileName = '/user/'.$pageName.'.twig';
    $viewData['metaTitle'] = \Services\Util::getMetaTitle($pageName);
    $viewData['pageTitle'] = \Services\Util::getPageTitle($pageName);
    $viewData['activePage'] = $pageName;
    return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
})->setName('login');

//user login form
$app->put('/login', function ($request, $response, $args) use ($app) {
    $parsedBody = $request->getParsedBody();
    if (!isset($parsedBody['email']) || !isset($parsedBody['password'])){
        $status = 400;
        return $response->withJson(\Services\Util::createResponse($status), $status);
    } else {
        $userSession = \Services\Authentication::startUserSession($parsedBody['email'],$parsedBody['password']);
        return $response->withJson($userSession, $userSession['status']);
    }
});

//new user page
$app->get('/register', function ($request, $response, $args) use ($app) {
    $pageName = 'register';
    $fileName = '/user/'.$pageName.'.twig';
    $viewData['metaTitle'] = \Services\Util::getMetaTitle($pageName);
    $viewData['pageTitle'] = \Services\Util::getPageTitle($pageName);
    $viewData['activePage'] = $pageName;
    return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
})->setName('register');

//user profile page
$app->get('/profile', function ($request, $response, $args) use ($app) {
    $pageName = 'profile';
    $fileName = '/user/'.$pageName.'.twig';
    $viewData['metaTitle'] = \Services\Util::getMetaTitle($pageName);
    $viewData['pageTitle'] = \Services\Util::getPageTitle($pageName);
    $viewData['activePage'] = $pageName;
    return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
})->setName('profile');

//user logout route
$app->get('/logout', function ($request, $response, $args) use ($app) {
    Services\Authentication::endUserSession();
    return $this->redirect('/');
})->setName('logout');
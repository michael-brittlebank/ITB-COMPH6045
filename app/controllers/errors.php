<?php

//404
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        $viewData['pageTitle'] = '404 Error';
        $viewData['viewsDirectory'] = VIEW_DIRECTORY;
        return $container['view']
            ->render($response, 'errors/404.phtml', $viewData)
            ->withStatus(404);
    };
};

//general error
$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        $viewData['pageTitle'] = '500 Error';
        $viewData['viewsDirectory'] = VIEW_DIRECTORY;
        if (DEBUG){
            $viewData['exception'] = $exception;
        }
        return $container['view']
            ->render($response, 'errors/500.phtml', $viewData)
            ->withStatus(500);
    };
};
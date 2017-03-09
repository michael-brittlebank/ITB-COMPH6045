<?php

//404
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        $viewData['pageTitle'] = '404 Error';
        $viewData['viewsDirectory'] = getenv('VIEW_DIRECTORY');
        return $container['view']
            ->render($response, 'errors/404.twig', $viewData)
            ->withStatus(404);
    };
};

//general error
$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        $viewData['pageTitle'] = '500 Error';
        $viewData['viewsDirectory'] = getenv('VIEW_DIRECTORY');
        if (getenv('DEBUG')){
            $viewData['exception'] = $exception;
        }
        return $container['view']
            ->render($response, 'errors/500.twig', $viewData)
            ->withStatus(500);
    };
};
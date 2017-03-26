<?php

//404
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        $viewData['metaTitle'] = Services\Util::getErrorMetaTitle('404');
        $viewData['globals'] = $request->getAttribute('globals');
        return $container['view']
            ->render($response, 'errors/404.twig', $viewData)
            ->withStatus(404);
    };
};

//general error
$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        $viewData['metaTitle'] = Services\Util::getErrorMetaTitle('500');
        $viewData['globals'] = $request->getAttribute('globals');
        if (getenv('DEBUG')){
            $viewData['exception'] = $exception;
        }
        return $container['view']
            ->render($response, 'errors/500.twig', $viewData)
            ->withStatus(500);
    };
};
<?php
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->add(function (Request $request, Response $response, callable $next) {
    $uri = $request->getUri();
    $path = $uri->getPath();
    if (strripos($path,'/public') !== false && strripos($path,'/webapp') === false) {
        // permanently redirect asset paths to subdirectory
        $uri = $uri->withPath('/webapp'.$path);
        return $response->withRedirect((string)$uri, 301);
    }
    return $next($request, $response);
});
<?php
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->add(function (Request $request, Response $response, callable $next) {
    $path = $request->getUri()->getPath();
    $request = $request->withAttribute('globals', array(
        'path' => $path,
        'imagesDirectory' => '/public/images/'
    ));
    return $next($request, $response);
});
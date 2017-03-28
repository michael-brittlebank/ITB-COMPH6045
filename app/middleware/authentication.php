<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->add(function (Request $request, Response $response, callable $next) {
    //validate user session
    if (\Services\Authentication::isUserSessionStarted()){
        if (time() > \Services\Authentication::getSessionExpiry()){
            //expired session
            \Services\Authentication::endUserSession();
        } else {
            //update session expiry due to user activity
            \Services\Authentication::setSessionExpiry();
            $request = $request->withAttribute('user', \Services\Authentication::getSessionUser()->toString());
        }
    }

    return $next($request, $response);
});

$isUserLoggedIn = function ($request, $response, $next) {
    if (\Services\Authentication::isUserSessionStarted()){
        return $next($request, $response);
    } else {
        return $response->withRedirect('/login');
    }
};

$isUserAdmin = function ($request, $response, $next) {
    if (\Services\Authentication::isUserSessionStarted() && \Services\Authentication::getSessionUser()->isAdmin()) {
        return $next($request, $response);
    } else {
        return $response->withRedirect('/login');
    }
};
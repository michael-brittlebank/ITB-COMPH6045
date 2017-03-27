<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->add(function (Request $request, Response $response, callable $next) {
    //validate user session
    if (isset($_SESSION['expiry'])){
        if (time() > $_SESSION['expiry']){
            //expired session
            \Services\Authentication::endUserSession();
        } else {
            //update session expiry due to user activity
            \Services\Authentication::updateSessionExpiry();
            $request = $request->withAttribute('user', $_SESSION['user']->toString());
        }
    }

    return $next($request, $response);
});

$isUserLoggedIn = function ($request, $response, $next) {
    if (isset($_SESSION['expiry'])) {
        return $next($request, $response);
    } else {
        return $response->withRedirect('/login');
    }
};

$isUserAdmin = function ($request, $response, $next) {
    if (isset($_SESSION['user']) && $_SESSION['user']->isAdmin()) {
        return $next($request, $response);
    } else {
        return $response->withRedirect('/login');
    }
};
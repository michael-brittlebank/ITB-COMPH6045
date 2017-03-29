<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->add(function (Request $request, Response $response, callable $next) {
    //validate user session
    if (\Services\Session::isUserSessionStarted()){
        if (time() > \Services\Session::getSessionExpiry()){
            //expired session
            \Services\Session::endUserSession();
        } else {
            //update session expiry due to user activity
            \Services\Session::setSessionExpiry();
            $request = $request->withAttribute('user', \Services\Session::getSessionUser()->toString());
        }
    }

    return $next($request, $response);
});

$isUserLoggedIn = function ($request, $response, $next) {
    if (\Services\Session::isUserSessionStarted()){
        return $next($request, $response);
    } else {
        return $response->withRedirect('/login');
    }
};

$userHasSession = function ($request, $response, $next) {
    if (\Services\Session::isUserSessionStarted()){
        return $response->withRedirect('/profile');
    } else {
        return $next($request, $response);
    }
};

$isUserAdmin = function ($request, $response, $next) {
    if (\Services\Session::isUserSessionStarted() && \Services\Session::getSessionUser()->isAdmin()) {
        return $next($request, $response);
    } else {
        return $response->withRedirect('/login');
    }
};

$userHasCart = function ($request, $response, $next) {
    $cart = \Services\Session::getSessionCart();
    if (is_array($cart) && !empty($cart)) {
        return $next($request, $response);
    } else {
        return $response->withRedirect('/cart');
    }
};
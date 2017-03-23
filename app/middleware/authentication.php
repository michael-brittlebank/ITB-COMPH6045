<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->add(function (Request $request, Response $response, callable $next) {
//    var_dump(Services\Authentication::createPasswordHash('pass123', '!ô8xßË7Þû÷”J1Å,["_†Àç'));
//    die();
//    var_dump(session_id());
//    die();

    return $next($request, $response);
});
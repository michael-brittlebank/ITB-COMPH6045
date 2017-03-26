<?php

/**
 * services
 */
$servicesPath = 'services';
$servicesFiles = [
    'util',
    'database',
    'authentication',
    'user'
];

//load files
foreach($servicesFiles as $services){
    $filePath = join('/',[$_SERVER['DOCUMENT_ROOT'], 'app', $servicesPath, $services.'.php']);
    include_once($filePath);
}

/**
 * models
 */
$modelsPath = 'models';
$modelsFiles = [
    'user',
];

//load files
foreach($modelsFiles as $models){
    $filePath = join('/',[$_SERVER['DOCUMENT_ROOT'], 'app', $modelsPath, $models.'.php']);
    include_once($filePath);
}

//start the session after the core files are loaded
session_start();

/**
 * middleware
 */
$middlewarePath = 'middleware';
$middlewareFiles = [
    'assets',
    'trailing-slash',
    'authentication',
    'data'
];

//load files
foreach($middlewareFiles as $middleware){
    $filePath = join('/',[$_SERVER['DOCUMENT_ROOT'], 'app', $middlewarePath, $middleware.'.php']);
    include_once($filePath);
}


/**
 * controllers
 */
$controllerPath = 'controllers';
$controllerFiles = [
    'errors',
    'shop',
    'checkout',
    'user',
    'admin',
    'pages'
];

//load files
foreach($controllerFiles as $controller){
    $filePath = join('/',[$_SERVER['DOCUMENT_ROOT'], 'app', $controllerPath, $controller.'.php']);
    include_once($filePath);
}

/**
 * routes
 */
$routePath = 'routes';
$routeFiles = [
    'shop',
    'checkout',
    'user',
    'admin',
    'pages'
];

//load files
foreach($routeFiles as $route){
    $filePath = join('/',[$_SERVER['DOCUMENT_ROOT'], 'app', $routePath, $route.'.php']);
    include_once($filePath);
}
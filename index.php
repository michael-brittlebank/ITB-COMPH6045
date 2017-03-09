<?php
require 'vendor/autoload.php';

//slim config
require_once('app/services/config.php');
loadEnvConfig();

$config = [];
if (getenv('DEBUG') === true){
    $config['settings'] = [
        'displayErrorDetails' => true
    ];
}

//http compression
$config['cache'] = function () {
    return new \Slim\HttpCache\CacheProvider();
};

//create slim app
$app = new \Slim\App($config);

//caching
$app->add(new \Slim\HttpCache\Cache('public', 86400));

//get slim container
$container = $app->getContainer();

$container['cache'] = function () {
    return new \Slim\HttpCache\CacheProvider();
};

//register view system with slim
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(getenv('VIEW_DIRECTORY'), [
//        'cache' => 'webapp/public/cache'
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

//load bootstrapper
include_once('app/services/bootstrapper.php');

$app->run();
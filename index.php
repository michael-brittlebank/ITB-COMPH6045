<?php

//load composer packages
require 'vendor/autoload.php';

//environment variables
require_once('app/services/config.php');
$envConfig = new \Services\Config();
$envConfig->validateLoadedConfig();

//slim config
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
        'cache' => false,
        'debug' => getenv('DEBUG')
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};

//bootstrap remaining files
require_once('app/bootstrapper.php');

$app->run();
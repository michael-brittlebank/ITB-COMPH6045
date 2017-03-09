<?php

function loadEnvConfig(){
    $dotenv = new Dotenv\Dotenv($_SERVER['DOCUMENT_ROOT']);
    $dotenv->load();
    validateLoadedConfig($dotenv);
}

function validateLoadedConfig($dotenv){
    //https://packagist.org/packages/vlucas/phpdotenv

    //general values
    $dotenv->required([
        'META_TITLE_PREFIX',
        'DEBUG'
    ]);

    //required non-empty values
    $dotenv->required([
        'VIEW_DIRECTORY',
        'MYSQL_HOST',
        'MYSQL_DATABASE',
        'MYSQL_USER',
        'MYSQL_PASSWORD',
        'MYSQL_PORT'
    ])->notEmpty();
}
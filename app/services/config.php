<?php
namespace Services;

use Dotenv;

class Config {
    
    private $dotenv;

    public function __construct() {
        $this->dotenv = new Dotenv\Dotenv($_SERVER['DOCUMENT_ROOT']);
        $this->dotenv->load();
    }

    public function validateLoadedConfig() {
        //https://packagist.org/packages/vlucas/phpdotenv

        //general values
        $this->dotenv->required([
            'SITE_NAME',
            'DEBUG'
        ]);

        //required non-empty values
        $this->dotenv->required([
            'VIEW_DIRECTORY',
            'MYSQL_HOST',
            'MYSQL_DATABASE',
            'MYSQL_USER',
            'MYSQL_PASSWORD',
            'MYSQL_PORT'
        ])->notEmpty();
    }
}
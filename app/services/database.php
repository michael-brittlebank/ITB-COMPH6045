<?php

namespace Services;

use ezSQL_mysqli;

class Database {

    public static function getConnection(){
        $globalConnectionVariable = 'DB_CONNECTION';
        if (!isset($GLOBALS[$globalConnectionVariable])){
            $GLOBALS[$globalConnectionVariable] = new ezSQL_mysqli(getenv('MYSQL_USER'),getenv('MYSQL_PASSWORD'),getenv('MYSQL_DATABASE'),getenv('MYSQL_HOST'));
        }
        return $GLOBALS[$globalConnectionVariable];
    }
}
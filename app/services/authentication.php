<?php

namespace Services;

class Authentication {
    public static function startUserSession(){
        //todo, http://php.net/manual/en/session.security.php
    }
    
    public static function endUserSession(){
        
    }

    public static function createPasswordHash($password, $salt){
        //http://php.net/manual/en/function.password-hash.php
        return password_hash($password, PASSWORD_BCRYPT, ['salt'=>$salt]);
    }

    public static function createHashSalt(){
        return mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
    }
}
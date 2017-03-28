<?php

namespace Services;

class Authentication {
    public static function encryptPassword($password, $salt){
        //http://php.net/manual/en/function.password-hash.php
        return password_hash($password, PASSWORD_BCRYPT, ['salt'=>$salt]);
    }

    public static function createSalt(){
        return mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
    }
}
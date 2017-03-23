<?php

namespace Services;

class User {
    public static function getUserByEmail($email){
        $result = Database::getConnection()->get_row("SELECT * FROM user WHERE email = '$email'");
        if (!is_null($result)){
            return new \Models\User($result);
        } else {
            return null;
        }
    }
}
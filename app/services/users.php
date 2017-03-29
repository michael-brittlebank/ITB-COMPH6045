<?php

namespace Services;

use \Models\User;

class Users {
    public static function getUserByEmail($email){
        $result = Database::getConnection()->get_row("SELECT * FROM user WHERE email = '$email'");
        if (!is_null($result)){
            return new User($result);
        } else {
            return null;
        }
    }

    public static function createNewUser(){
        //todo, user registration
    }

    public static function updateUser($userFirstName, $userLastName, $userEmail, $userId){
        $result = Database::getConnection()->query("UPDATE user SET first_name = '$userFirstName', last_name='$userLastName', email='$userEmail' WHERE id='$userId'");
        return $result;
    }

    public static function setUserCart($cart){
        $cart = json_encode($cart);
        $userId = Session::getSessionUser()->getId();
        $result = Database::getConnection()->query("UPDATE user SET stringified_cart = '$cart' WHERE id='$userId'");
        return $result;
    }
    
    public static function updateUserPassword($plainTextPassword, $userSalt, $userId){
        $hashedPassword = Authentication::encryptPassword($plainTextPassword,$userSalt);
        $result = Database::getConnection()->query("UPDATE user SET password_hash = '$hashedPassword' WHERE id='$userId'");
        return $result;
    }
}
<?php

namespace Services;

class Authentication {
    public static function startUserSession($email, $password){
        if (empty($email) || empty($password)){
            //missing parameters
            return Util::createResponse(400);
        } else {
            $user = User::getUserByEmail($email);
            if (is_null($user)){
                //invalid email
                return Util::createResponse(401);
            } else {
                if ($user->authenticateUserPassword($password)){
                    //successfully authenticated
                    session_start();
                    session_regenerate_id(true);
                    return Util::createResponse(200);
                } else {
                    //invalid password
                    return Util::createResponse(401);
                }
            }
        }
    }

    public static function endUserSession(){
        //http://php.net/manual/en/function.session-destroy.php
        session_start();
        // Unset all of the session variables.
        $_SESSION = array();
        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        // Finally, destroy the session.
        session_destroy();
    }

    public static function encryptPassword($password, $salt){
        //http://php.net/manual/en/function.password-hash.php
        return password_hash($password, PASSWORD_BCRYPT, ['salt'=>$salt]);
    }

    public static function createSalt(){
        return mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
    }
}
<?php

namespace Services;

class Session {

    public static function startUserSession($email, $password){
        if (empty($email) || empty($password)){
            //missing parameters
            return Util::createResponse(400);
        } else {
            $user = Users::getUserByEmail($email);
            if (is_null($user)){
                //invalid email
                return Util::createResponse(401);
            } else {
                if ($user->authenticateUserPassword($password)){
                    //successfully authenticated
                    session_regenerate_id(true);
                    self::setSessionUser($user);
                    self::setSessionExpiry();
                    return true;
                } else {
                    //invalid password
                    return false;
                }
            }
        }
    }

    public static function endUserSession(){
        //http://php.net/manual/en/function.session-destroy.php
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

    public static function isUserSessionStarted(){
        return isset($_SESSION['expiry']);
    }

    public static function setSessionUser($user){
        $_SESSION['user'] = $user;
    }

    public static function getSessionUser(){
        return $_SESSION['user'];
    }

    public static function setSessionExpiry(){
        $minutes = 30 * ($secondsInMinute = 60);
        $_SESSION['expiry'] = time() + $minutes;
    }

    public static function getSessionExpiry(){
        return $_SESSION['expiry'];
    }

}
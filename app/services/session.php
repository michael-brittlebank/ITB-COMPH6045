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
                    $userCart = $user->getCart();
                    $sessionCart = self::getSessionCart();
                    $mergedCart = array_replace($userCart,$sessionCart);
                    self::setSessionCart($mergedCart);
                    Users::setUserCart();
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
        return isset($_SESSION['user'])?$_SESSION['user']:array();
    }

    public static function setSessionPreferences($preferences){
        $_SESSION['preferences'] = $preferences;
    }

    public static function getSessionPreferences(){
        return isset($_SESSION['preferences'])?$_SESSION['preferences']:array();
    }

    public static function setSessionExpiry(){
        $minutes = 30 * ($secondsInMinute = 60);
        $_SESSION['expiry'] = time() + $minutes;
    }

    public static function getSessionExpiry(){
        return isset($_SESSION['expiry'])?$_SESSION['expiry']:array();
    }

    public static function setSessionCart($cart){
        if(!is_array($cart)){
            $cart = array();
        }
        $_SESSION['cart'] = $cart;
    }

    public static function getSessionCart(){
        return isset($_SESSION['cart'])?$_SESSION['cart']:array();
    }
    
    public static function getStringifiedSessionCart(){
        return json_encode(self::getSessionCart());
    }

}
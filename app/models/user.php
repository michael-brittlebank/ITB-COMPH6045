<?php

namespace Models;

use Services\Authentication;

class User {

    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $role;
    private $passwordSalt;
    private $passwordHash;
    private $cart;

    public function __construct($user){
        $this->id = (int)$user->id;
        $this->firstName = $user->first_name;
        $this->lastName = $user->last_name;
        $this->email = $user->email;
        $this->role = (int)$user->role;
        $this->passwordSalt = $user->password_salt;
        $this->passwordHash = $user->password_hash;
        $cart = array();
        if(!empty($user->stringified_cart)) {
            try {
                $cart = json_decode($user->stringified_cart,true);
            } catch (\Exception $exception) {

            }
        }
        $this->cart = $cart;
    }

    public function isAdmin(){
        return $this->role === 1;
    }

    public function getId(){
        return $this->id;
    }

    public function getCart(){
        return $this->cart;
    }

    public function toString(){
        return array(
            'id'=>$this->id,
            'firstName'=>$this->firstName,
            'lastName'=>$this->lastName,
            'email'=>$this->email,
            'role'=>$this->role,
            'cart'=>$this->cart
        );
    }

    public function isCurrentUser($userId){
        return $this->id === (int)$userId;
    }

    public function authenticateUserPassword($plainTextPassword){
        return Authentication::encryptPassword($plainTextPassword, $this->passwordSalt) === $this->passwordHash;
    }
}
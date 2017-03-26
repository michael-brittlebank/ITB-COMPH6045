<?php

namespace Models;

use Services\Authentication;

class User {

    private $firstName;
    private $lastName;
    private $email;
    private $role;
    private $passwordSalt;
    private $passwordHash;
    
    public function __construct($user){
        $this->firstName = $user->first_name;
        $this->lastName = $user->last_name;
        $this->email = $user->email;
        $this->role = (int)$user->role;
        $this->passwordSalt = $user->password_salt;
        $this->passwordHash = $user->password_hash;
    }

    public function isAdmin(){
        return $this->role === 1;
    }

    public function toString(){
        return [
            'firstName'=>$this->firstName,
            'lastName'=>$this->lastName,
            'email'=>$this->email,
            'role'=>$this->role
        ];
    }
    
    public function authenticateUserPassword($plainTextPassword){
        return Authentication::encryptPassword($plainTextPassword, $this->passwordSalt) === $this->passwordHash;
    }
}
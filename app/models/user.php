<?php

namespace Models;

class User {

    private $firstName;
    private $lastName;
    private $email;
    private $role;

    public function __construct($firstName, $lastName, $email, $role){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->role = $role;
    }

    public function isAdmin(){
        return $this->role === 1;
    }

    public function getUserObject(){
        return [
            'firstName'=>$this->firstName,
            'lastName'=>$this->lastName,
            'email'=>$this->email,
            'role'=>$this->role
        ];
    }

    public function toString(){
        return $this->firstName.' '.$this->lastName;
    }
}
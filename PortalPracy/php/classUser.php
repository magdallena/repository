<?php

class User {
    protected $email;
    protected $password;
    
    function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }
}
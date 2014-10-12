<?php

class User {

    protected $email;
    protected $password;

    

    function __construct() {
        
    }

    function set_email_password($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_password() {
        return $this->password;
    }
}

<?php

include_once 'classUser.php';
include_once 'classDatabase.php';

class Company extends User {

    private $mysqli;
    function __construct($email, $password) {
        parent::__construct($email, $password);
        $this->mysqli = new Database();
    }

    function login() {
        
        $checkresult = $this->mysqli->check_company($this->email, $this->password);
        if (!$checkresult) {
            echo "<h3>Niepoprawna nazwa użytkownika (firma) i/lub hasło</h3>";
            echo "<p><a href='login.php'>Przejdź do formularza logowania</a></p>";
        } else {
            session_start();
            $_SESSION['usertype'] = "nauczyciel";
            $_SESSION['name'] = $this->email;
            echo "<h3>Użytkownik zalogowany jako: " . $_SESSION['name'] . "</h3>";
            //header('Refresh: 1; index.php');
        }
    }

}



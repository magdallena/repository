<?php

include_once 'classUser.php';
include_once 'classDatabase.php';

class Student extends User {

    private $mysqli;

    function __construct($email, $password) {
        parent::__construct($email, $password);
        $this->mysqli = new Database();
    }

    function login() {

        $checkresult = $this->mysqli->check_student($this->email, $this->password);
        if (!$checkresult) {
            echo "<h3>Niepoprawna nazwa użytkownika (student) i/lub hasło</h3>";
            echo "<p><a href='login.php'>Przejdź do formularza logowania</a></p>";
        } else {
            session_start();
            $admin = $this->mysqli->check_admin($this->email);
            if ($admin == 1) {
                $_SESSION['usertype'] = "admin";
            } else {
                $_SESSION['usertype'] = "student";
            }
            $_SESSION['name'] = $this->email;
            echo "<h3 class='padding'>Użytkownik zalogowany jako: " . $_SESSION['name'] . "</h3>";
            //header('Refresh: 1; index.php');
        }
    }

}

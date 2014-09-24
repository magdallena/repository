<?php

class Database {
    private $db;
    private $server;
    private $user;
    private $password;
    private $basename;
    
    function __construct() {
        $this->server = 'localhost';
        $this->user = 'root';
        $this->password = '';
        $this->basename = 'data_base';
        $this->db = new mysqli($this->server, $this->user, $this->password, $this->basename);
        if ($this->db->connect_error) {
            die('Blad polaczenia z baza danych (' . $this->db->connect_errno . ') ' . $this->db->connect_error);
        } else {
            $this->db->query("SET NAMES 'utf8'");
        }
        
    }
    
    function __destruct() {
        $this->db->close();
    }
    
    function check_student($email, $password) { 
        if ($result = $this->db->query("SELECT * FROM `student` WHERE `e-mail`='$email' and `password`='$password'")) {
            if ($result->num_rows == 0) {
                $result->close();
                return false;
            } else {
                $result->close();
                return true;
            }
        } 
    }
    function check_teacher($email, $password) {
        if ($result = $this->db->query("SELECT * FROM `teacher` WHERE `e-mail`='$email' and `password`='$password'")) {
            if ($result->num_rows == 0) {
                $result->close();
                return false;
            } else {
                $result->close();
                return true;
            }
        }
    }
    
    function check_company($email, $password) {
        if ($result = $this->db->query("SELECT * FROM `company` WHERE `e-mail`='$email' and `password`='$password'")) {
            if ($result->num_rows == 0) {
                $result->close();
                return false;
            } else {
                $result->close();
                return true;
            }
        }
    }
    
    function check_admin($email) {
        if ($result = $this->db->query("SELECT `is_admin` FROM `student` WHERE `e-mail`='$email'")) {
            $obj = $result->fetch_object();
            return $obj->is_admin;
        }
    }
}

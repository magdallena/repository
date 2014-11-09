<?php

include_once 'classUser.php';
include_once 'classDatabase.php';

class Company extends User {

    private $mysqli;
    private $id;
    private $name;
    private $address;
    private $telephone;
    private $password2;
    private $date;
    private $photo;

    public static function make_new_with_email_password($email, $password) {
        $obj = new Company();
        $obj->set_email_password($email, $password);
        return $obj;
    }

    function __construct() {
        parent::__construct();
        $this->mysqli = new Database();
    }

    public static function make_new_to_register() {
        $obj = new Company();
        $obj->set_parameters();
        return $obj;
    }

    public static function make_new_to_edit($email) {
        $obj = new Company();
        $obj->set_parameters_to_edit($email);
        return $obj;
    }

    public static function make_new_with_id($id) {
        $obj = new Company();
        $obj->set_id($id);
        return $obj;
    }
    
    function set_parameters() {
        $this->name = addslashes(strip_tags(trim($_POST['name'])));
        $this->address = addslashes(strip_tags(trim($_POST['address'])));
        $this->telephone = addslashes(strip_tags(trim($_POST['telephone'])));
        $this->email = addslashes(strip_tags(trim($_POST['email'])));
        $this->password = md5(addslashes(strip_tags(trim($_POST['passwordc']))));
        $this->password2 = md5(addslashes(strip_tags(trim($_POST['password2']))));
        $date2 = new DateTime('now');
        $this->date = $date2->format('Y-m-d');
    }

    function set_parameters_to_edit($email) {
        $this->name = addslashes(strip_tags(trim($_POST['name'])));
        $this->address = addslashes(strip_tags(trim($_POST['address'])));
        $this->telephone = addslashes(strip_tags(trim($_POST['telephone'])));
        $this->email = $email;
    }

    function set_id($id) {
        $this->id=$id;
    }
    
    function create_company() {
        $ok = true;
        if (!$this->check_name()) {
            $ok = false;
            echo "<h3>Niepoprawna nazwa firmy: " . $this->name . "</h3>";
        }
        if (!$this->check_address()) {
            $ok = false;
            echo "<h3>Niepoprawny adres: </h3>";
        }
        if (!$this->check_telephone()) {
            $ok = false;
            echo "<h3>Niepoprawny numer telefonu: " . $this->telephone . "</h3>";
        }
        if (!$this->check_email()) {
            $ok = false;
            echo "<h3>Niepoprawny email lub podany email już istnieje w bazie: " . $this->email . "</h3>";
        }
        if (!$this->check_password()) {
            $ok = false;
            echo "<h3>Niepoprawne hasło (min. 8 znaków)</h3>";
        }
        if (!$this->check_password2()) {
            $ok = false;
            echo "<h3>Nie powtórzono hasła</h3>";
        }
        if (!$this->check_photo()) {
            $ok = false;
        }
        if (!$ok) {
            echo "<h2'><a href='register.php'>Powrót do formularza rejestracji</a></h2>";
        } else {
            $this->mysqli->insert_company($this);
            echo "<h3'>Konto zostało utworzone, ale nie jest jeszcze aktywne. Musisz poczekać na akceptację administratora.</h3>";
        }
    }

    function update_data() {
        $ok = true;
        if (!$this->check_name()) {
            $ok = false;
            echo "<h3>Niepoprawna nazwa firmy: " . $this->name . "</h3>";
        }
        if (!$this->check_address()) {
            $ok = false;
            echo "<h3>Niepoprawny adres: </h3>";
        }
        if (!$this->check_telephone()) {
            $ok = false;
            echo "<h3>Niepoprawny numer telefonu: " . $this->telephone . "</h3>";
        }
        if (!$ok) {
            echo "<h2'><a href='edit_data.php'>Powrót do formularza edycji</a></h2>";
        } else {
            $this->mysqli->update_company($this);
            echo "<h2'>Dane zostały zauktualizowane</h2>";
            header('Refresh: 3; index.php');
        }
    }
    
    function check_name() {
        $ok = true;
        if ($this->name == '' or strlen($this->name) < 2) {
            $ok = false;
        }
        return $ok;
    }

    function check_address() {
        $ok = true;
        if ($this->address == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_telephone() {
        $ok = true;
        if ($this->telephone == '' or strlen($this->telephone) != 9) {
            $ok = false;
        }
        return $ok;
    }

    function check_email() {
        $ok = true;
        if ($this->email == '' or $this->mysqli->check_company_email($this->email)) {
            $ok = false;
        }
        return $ok;
    }

    function check_password() {
        $ok = true;
        if ($this->password == '' or strlen($this->password) < 8) {
            $ok = false;
        }
        return $ok;
    }

    function check_password2() {
        $ok = true;
        if (strcmp($this->password, $this->password2)) {
            $ok = false;
        }
        return $ok;
    }

    function check_photo() {
        $ok = true;
        if ((($_FILES["photo"]["type"] == "image/gif") || ($_FILES["photo"]["type"] == "image/jpeg") || ($_FILES["photo"]["type"] == "image/jpg")) && ($_FILES["photo"]["size"] < 1000000)) {
            if ($_FILES["photo"]["error"] > 0) {
                echo "<h3>Błędny plik: " . $_FILES["photo"]["error"] . "</h3>";
                $ok = false;
            }

            $filename = basename($_FILES['photo']['name']);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $hour2=new DateTime("now");
            $hour=$hour2->format("H-i");
            $newname = $this->name . $this->date .'-'.$hour. '.' . $extension;
            $path = "../galery_company/" . $newname;
            $tmp_name = $_FILES['photo']['tmp_name'];
            $this->photo = $newname;
            if (!move_uploaded_file($tmp_name, $path)) {
                "<h3>Plik nie został wysłany</h3>";
                $ok = false;
            }
        } else {
            echo "<h3>Niepoprawny plik.</h3>";
            $ok = false;
        }
        return $ok;
    }

    function login() {

        $checkresult = $this->mysqli->check_company($this->email, $this->password);
        if (!$checkresult) {
            echo "<h3>Niepoprawna nazwa użytkownika (firma) i/lub hasło</h3>";
            echo "<p><a href='login.php'>Przejdź do formularza logowania</a></p>";
        } else if (!$this->mysqli->check_company_active($this->email)) {
            echo "<h3>Twoje konto nie jest jeszcze aktywne. Musisz poczekać na akceptację administratora</h3>";
        } else {
            session_start();
            $_SESSION['usertype'] = "firma";
            $_SESSION['name'] = $this->email;
            $_SESSION['id']= $this->mysqli->get_company_id($this->email);
            echo "<h3>Użytkownik zalogowany jako: " . $_SESSION['name'] . " <a href='logout.php'>(wyloguj)</a></h3>";
            header('Refresh: 2; index.php');
        }
    }

    function change_password() {
        if (!$this->mysqli->check_company($this->email, $this->password)) {
            echo "<h3>Niepoprawne stare hasło, nie można ustawić nowego.</h3>";
            echo "<p><a href='change_password.php'>Przejdź do formularza zmiany hasła.</a></p>";
        } else {
            $this->password = md5(htmlspecialchars($_POST['password']));
            $this->password2 = md5(htmlspecialchars($_POST['password2']));
            $ok = true;
            if (!$this->check_password()) {
                $ok = false;
                echo "<h3>Niepoprawne hasło (min. 8 znaków)</h3>";
            }
            if (!$this->check_password2()) {
                $ok = false;
                echo "<h3>Nie powtórzono hasła</h3>";
            }
            if (!$ok) {
                echo "<h2'><a href='change_password.php'>Powrót do formularza zmiany hasła</a></h2>";
            } else {
                $this->mysqli->update_company_password($this);
                echo "<h2'>Hasło zostało zmienione</h2>";
                header('Refresh: 3; index.php');
            }
        }
    }
    
    function change_photo() {
        $old_photo = $this->mysqli->get_company_photo($this->id); 
        $this->name = $this->mysqli->get_company_name($this->id);
        $date2 = new DateTime('now');
        $this->date = $date2->format('Y-m-d');
        if ($this->check_photo()) {
            unlink("../galery_company/".$old_photo);
            $this->mysqli->update_company_photo($this);
            echo "<h2'>Zdjęcie zostało zmienione</h2>";
        }
        else {
            echo"<p><a href='change_photo.php'>Przejdź do formularza zmiany zdjęcia.</a></p>";
        }
    }
    
    public function get_name() {
        return $this->name;
    }

    public function get_address() {
        return $this->address;
    }

    public function get_telephone() {
        return $this->telephone;
    }

    public function get_date() {
        return $this->date;
    }

    public function get_photo() {
        return $this->photo;
    }
    public function get_id() {
        return $this->id;
    }


}

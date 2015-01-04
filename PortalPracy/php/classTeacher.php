<?php

include_once 'classUser.php';
include_once 'classDatabase.php';

class Teacher extends User {

    private $mysqli;
    private $id;
    private $name;
    private $last_name;
    private $degree;
    private $telephone;
    private $password2;
    private $date;

    public static function make_new_with_email_password($email, $password) {
        $obj = new Teacher();
        $obj->set_email_password($email, $password);
        return $obj;
    }

    public static function make_new_to_register() {
        $obj = new Teacher();
        $obj->set_parameters();
        return $obj;
    }

    public static function make_new_to_edit($email) {
        $obj = new Teacher();
        $obj->set_parameters_to_edit($email);
        return $obj;
    }

    public static function make_new_with_id($id) {
        $obj = new Teacher();
        $obj->set_id($id);
        return $obj;
    }

    function set_parameters() {
        $this->name = addslashes(strip_tags(trim($_POST['name'])));
        $this->last_name = addslashes(strip_tags(trim($_POST['last_name'])));
        $this->degree = addslashes(strip_tags(trim($_POST['degree'])));
        $this->telephone = addslashes(strip_tags(trim($_POST['telephone'])));
        $this->email = addslashes(strip_tags(trim($_POST['email'])));
        $this->password = md5(addslashes(strip_tags(trim($_POST['passwordt']))));
        $this->password2 = md5(addslashes(strip_tags(trim($_POST['password2']))));
        $date2 = new DateTime('now');
        $this->date = $date2->format('Y-m-d');
    }

    function set_parameters_to_edit($email) {
        $this->name = addslashes(strip_tags(trim($_POST['name'])));
        $this->last_name = addslashes(strip_tags(trim($_POST['last_name'])));
        $this->degree = addslashes(strip_tags(trim($_POST['degree'])));
        $this->telephone = addslashes(strip_tags(trim($_POST['telephone'])));
        $this->email = $email;
    }

    function set_id($id) {
        $this->id = $id;
    }

    function __construct() {
        parent::__construct();
        $this->mysqli = new Database();
    }

    function create_teacher() {
        $ok = true;
        if (!$this->check_name()) {
            $ok = false;
            echo "<h3>Niepoprawne imię: " . $this->name . "</h3>";
        }
        if (!$this->check_last_name()) {
            $ok = false;
            echo "<h3>Niepoprawne nazwisko: " . $this->last_name . "</h3>";
        }
        if (!$this->check_degree()) {
            $ok = false;
            echo "<h3>Niepoprawny stopień naukowy: " . $this->degree . "</h3>";
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
        if (!$ok) {
            echo "<h2'><a href='register.php'>Powrót do formularza rejestracji</a></h2>";
        } else {
            $this->mysqli->insert_teacher($this);
            echo "<h3'>Konto zostało utworzone, ale nie jest jeszcze aktywne. Musisz poczekać na akceptację administratora.</h3>";
        }
    }

    function update_data() {
        $ok = true;
        if (!$this->check_name()) {
            $ok = false;
            echo "<h3>Niepoprawne imię: " . $this->name . "</h3>";
        }
        if (!$this->check_last_name()) {
            $ok = false;
            echo "<h3>Niepoprawne nazwisko: " . $this->last_name . "</h3>";
        }
        if (!$this->check_degree()) {
            $ok = false;
            echo "<h3>Niepoprawny stopień naukowy: " . $this->degree . "</h3>";
        }
        if (!$this->check_telephone()) {
            $ok = false;
            echo "<h3>Niepoprawny numer telefonu: " . $this->telephone . "</h3>";
        }
        if (!$ok) {
            echo "<h2'><a href='edit_data.php'>Powrót do formularza edycji</a></h2>";
        } else {
            $this->mysqli->update_teacher($this);
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

    function check_last_name() {
        $ok = true;
        if ($this->last_name == '' or strlen($this->last_name) < 2) {
            $ok = false;
        }
        return $ok;
    }

    function check_degree() {
        $ok = true;
        if ($this->degree == '' or strlen($this->degree) < 2) {
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
        if ($this->email == '' or $this->mysqli->check_teacher_email($this->email)) {
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

    function login() {
        $checkresult = $this->mysqli->check_teacher($this->email, $this->password);

        if (!$checkresult) {
            echo "<h3>Niepoprawna nazwa użytkownika (nauczyciel) i/lub hasło</h3>";
            echo "<p><a href='login.php'>Przejdź do formularza logowania</a></p>";
        } else if (!$this->mysqli->check_teacher_active($this->email)) {
            echo "<h3>Twoje konto nie jest jeszcze aktywne. Musisz poczekać na akceptację administratora</h3>";
        } else {
            session_start();
            $_SESSION['usertype'] = "nauczyciel";
            $_SESSION['name'] = $this->email;
            $_SESSION['id'] = $this->mysqli->get_teacher_id($this->email);
            echo "<h3>Użytkownik zalogowany jako: " . $_SESSION['name'] . " <a href='logout.php'>(wyloguj)</a></h3>";
            header('Refresh: 2; index.php');
        }
    }

    function change_password() {
        if (!$this->mysqli->check_teacher($this->email, $this->password)) {
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
                $this->mysqli->update_teacher_password($this);
                echo "<h2'>Hasło zostało zmienione</h2>";
                header('Refresh: 3; index.php');
            }
        }
    }

    function reset_password() {
        //TO DO: wyslac maila z nowym haslem $this->pass
        $this->password = md5($this->password);
        $this->mysqli->update_teacher_password($this);
    }

    public function get_name() {
        return $this->name;
    }

    public function get_last_name() {
        return $this->last_name;
    }

    public function get_degree() {
        return $this->degree;
    }

    public function get_telephone() {
        return $this->telephone;
    }

    public function get_date() {
        return $this->date;
    }

    public function get_id() {
        return $this->id;
    }

}

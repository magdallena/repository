<?php

include_once 'classUser.php';
include_once 'classDatabase.php';

class Student extends User {

    private $mysqli;
    private $id;
    private $name;
    private $last_name;
    private $address;
    private $telephone;
    private $password2;
    private $education;
    private $languages;
    private $experience;
    private $skills;
    private $interest;
    private $employment_form;
    private $change_of_residence;
    private $salary;
    private $status;
    private $date;
    private $photo;

    public static function make_new_with_email_password($email, $password) {
        $obj = new Student();
        $obj->set_email_password($email, $password);
        return $obj;
    }

    public static function make_new_to_register() {
        $obj = new Student();
        $obj->set_parameters();
        return $obj;
    }

    public static function make_new_to_edit($email) {
        $obj = new Student();
        $obj->set_parameters_to_edit($email);
        return $obj;
    }

    public static function make_new_with_id($id) {
        $obj = new Student();
        $obj->set_id($id);
        return $obj;
    }
    
    function set_parameters() {
        $this->name = addslashes(strip_tags(trim($_POST['name'])));
        $this->last_name = addslashes(strip_tags(trim($_POST['last_name'])));
        $this->address = addslashes(strip_tags(trim($_POST['address'])));
        $this->telephone = addslashes(strip_tags(trim($_POST['telephone'])));
        $this->email = addslashes(strip_tags(trim($_POST['email'])));
        $this->password = md5(addslashes(strip_tags(trim($_POST['password']))));
        $this->password2 = md5(addslashes(strip_tags(trim($_POST['password2']))));
        $this->education = addslashes(strip_tags(trim($_POST['education'])));
        $this->languages = addslashes(strip_tags(trim($_POST['languages'])));
        $this->experience = addslashes(strip_tags(trim($_POST['experience'])));
        $this->skills = addslashes(strip_tags(trim($_POST['skills'])));
        $this->interest = addslashes(strip_tags(trim($_POST['interest'])));
        $this->employment_form = addslashes(strip_tags(trim($_POST['employment_form'])));
        $this->change_of_residence = addslashes(strip_tags(trim($_POST['change_of_residence'])));
        $this->salary = addslashes(strip_tags(trim($_POST['salary'])));
        $this->status = addslashes(strip_tags(trim($_POST['status'])));
        $date2 = new DateTime('now');
        $this->date = $date2->format('Y-m-d');
    }

    function set_parameters_to_edit($email) {
        $this->name = addslashes(strip_tags(trim($_POST['name'])));
        $this->last_name = addslashes(strip_tags(trim($_POST['last_name'])));
        $this->address = addslashes(strip_tags(trim($_POST['address'])));
        $this->telephone = addslashes(strip_tags(trim($_POST['telephone'])));
        $this->email = $email;
        $this->education = addslashes(strip_tags(trim($_POST['education'])));
        $this->languages = addslashes(strip_tags(trim($_POST['languages'])));
        $this->experience = addslashes(strip_tags(trim($_POST['experience'])));
        $this->skills = addslashes(strip_tags(trim($_POST['skills'])));
        $this->interest = addslashes(strip_tags(trim($_POST['interest'])));
        $this->employment_form = addslashes(strip_tags(trim($_POST['employment_form'])));
        $this->change_of_residence = addslashes(strip_tags(trim($_POST['change_of_residence'])));
        $this->salary = addslashes(strip_tags(trim($_POST['salary'])));
        $this->status = addslashes(strip_tags(trim($_POST['status'])));
    }
    
    function set_id($id) {
        $this->id=$id;
    }

    function __construct() {
        parent::__construct();
        $this->mysqli = new Database();
    }

    function create_student() {
        $ok = true;
        if (!$this->check_name()) {
            $ok = false;
            echo "<h3>Niepoprawne imię: " . $this->name . "</h3>";
        }
        if (!$this->check_last_name()) {
            $ok = false;
            echo "<h3>Niepoprawne nazwisko: " . $this->last_name . "</h3>";
        }
        if (!$this->check_address()) {
            $ok = false;
            echo "<h3>Niepoprawny adres</h3>";
        }
        if (!$this->check_telephone()) {
            $ok = false;
            echo "<h3>Niepoprawny numer telefonu: " . $this->telephone . "</h3>";
        }
        if (!$this->check_email()) {
            $ok = false;
            echo "<h3>Niepoprawny email lub podany email już istnieje w bazie: " . $this->email . "</h3>";
        }
        
        if (!$this->check_email_domain()) {
            $ok = false;
            echo "<h3>Niepoprawny email (musi być w domenie edu.pl): " . $this->email . "</h3>";
        }
        
        if (!$this->check_password()) {
            $ok = false;
            echo "<h3>Niepoprawne hasło (min. 8 znaków)</h3>";
        }
        if (!$this->check_password2()) {
            $ok = false;
            echo "<h3>Nie powtórzono hasła</h3>";
        }
        if (!$this->check_education()) {
            $ok = false;
            echo "<h3>Nie podano edukacji</h3>";
        }
        if (!$this->check_languages()) {
            $ok = false;
            echo "<h3>Nie podano języków obcych</h3>";
        }
        if (!$this->check_experience()) {
            $ok = false;
            echo "<h3>Nie podano doświadczenia</h3>";
        }
        if (!$this->check_skills()) {
            $ok = false;
            echo "<h3>Nie podano umiejętności</h3>";
        }
        if (!$this->check_employment_form()) {
            $ok = false;
            echo "<h3>Nie podano formy zatrudnienia</h3>";
        }
        if (!$this->check_salary()) {
            $ok = false;
            echo "<h3>Nie podano wynagrodzenia</h3>";
        }
        if (!$this->check_photo()) {
            $ok = false;
        }
        if (!$ok) {
            echo "<h2'><a href='register.php'>Powrót do formularza rejestracji</a></h2>";
        } else {
            $this->mysqli->insert_student($this);
            echo "<h3'>Konto zostało utworzone. Możesz się <a href='login.php'>zalogować</a></h3>";
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
        if (!$this->check_address()) {
            $ok = false;
            echo "<h3>Niepoprawny adres</h3>";
        }
        if (!$this->check_telephone()) {
            $ok = false;
            echo "<h3>Niepoprawny numer telefonu: " . $this->telephone . "</h3>";
        }
        if (!$this->check_education()) {
            $ok = false;
            echo "<h3>Nie podano edukacji</h3>";
        }
        if (!$this->check_languages()) {
            $ok = false;
            echo "<h3>Nie podano języków obcych</h3>";
        }
        if (!$this->check_experience()) {
            $ok = false;
            echo "<h3>Nie podano doświadczenia</h3>";
        }
        if (!$this->check_skills()) {
            $ok = false;
            echo "<h3>Nie podano umiejętności</h3>";
        }
        if (!$this->check_employment_form()) {
            $ok = false;
            echo "<h3>Nie podano formy zatrudnienia</h3>";
        }
        if (!$this->check_salary()) {
            $ok = false;
            echo "<h3>Nie podano wynagrodzenia</h3>";
        }
        if (!$ok) {
            echo "<h2'><a href='edit_data.php'>Powrót do formularza edycji</a></h2>";
        } else {
            $this->mysqli->update_student($this);
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
        if ($this->email == '' or $this->mysqli->check_student_email($this->email)) {
            $ok = false;
        }
        return $ok;
    }
    
    function check_email_domain() {
        return preg_match('/[a-zA-Z0-9\.]*@[a-zA-Z0-9\.]*edu.pl$/', $this->email);
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

    function check_education() {
        $ok = true;
        if ($this->education == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_languages() {
        $ok = true;
        if ($this->languages == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_experience() {
        $ok = true;
        if ($this->experience == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_skills() {
        $ok = true;
        if ($this->skills == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_interest() {
        $ok = true;
        if ($this->interest == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_employment_form() {
        $ok = true;
        if ($this->employment_form == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_salary() {
        $ok = true;
        if ($this->salary == '') {
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
            $newname = $this->last_name . $this->date .'-'.$hour. '.' . $extension;
            $path = "../galery_student/" . $newname;
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
        $checkresult = $this->mysqli->check_student($this->email, $this->password);
        if (!$checkresult) {
            echo "<h3>Niepoprawna nazwa użytkownika (student) i/lub hasło</h3>";
            echo "<p><a href='login.php'>Powrót do formularza logowania</a></p>";
        } else {
            session_start();
            $admin = $this->mysqli->check_admin($this->email);
            $_SESSION['usertype'] = "student";
            if ($admin == 1) {
                $_SESSION['admin'] = TRUE;
            } 
            $_SESSION['name'] = $this->email;
            $_SESSION['id']= $this->mysqli->get_student_id($this->email);
            echo "<h3 class='padding'>Użytkownik zalogowany jako: " . $_SESSION['name'] . " <a href='logout.php'>(wyloguj)</a></h3>";
            header('Refresh: 2; index.php');
        }
    }
    
    function change_photo() {
        $old_photo = $this->mysqli->get_student_photo($this->id); 
        $this->name = $this->mysqli->get_student_last_name($this->id);
        $date2 = new DateTime('now');
        $this->date = $date2->format('Y-m-d');
        if ($this->check_photo()) {
            //unlink("../galery_student/".$old_photo);
            $this->mysqli->update_student_photo($this);
            echo "<h2'>Zdjęcie zostało zmienione</h2>";
        }
        else {
            echo"<p><a href='change_photo.php'>Przejdź do formularza zmiany zdjęcia.</a></p>";
        }
    }

    function change_password() {
        if (!$this->mysqli->check_student($this->email, $this->password)) {
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
                $this->mysqli->update_student_password($this);
                echo "<h2'>Hasło zostało zmienione</h2>";
                header('Refresh: 3; index.php');
            }
        }
    }
    
    function reset_password() {
        //TO DO: wyslac maila z nowym haslem $this->pass
        require_once("class.phpmailer.php");
        $email = new PHPMailer();
        $email->From      = 'portalpracydlastudentow@gmail.com';
        $email->FromName  = 'Portal Pracy';
        $email->Subject   = 'Nowe haslo';
        $email->Body      = "Twoje nowe hasło to: \r\n"
                        . $this->password . "\r\n"
                        ."Po zalogowaniu możesz je zmienić.";
        $email->AddAddress( $this->email );
    //$email->AddAttachment( $file_to_attach , 'image.jpg' );

        if( $email->Send()) {}

        $this->password = md5($this->password);
        $this->mysqli->update_student_password($this);
        
    }

    public function get_name() {
        return $this->name;
    }

    public function get_last_name() {
        return $this->last_name;
    }

    public function get_address() {
        return $this->address;
    }

    public function get_telephone() {
        return $this->telephone;
    }

    public function get_education() {
        return $this->education;
    }

    public function get_languages() {
        return $this->languages;
    }

    public function get_experience() {
        return $this->experience;
    }

    public function get_skills() {
        return $this->skills;
    }

    public function get_interest() {
        return $this->interest;
    }

    public function get_employment_form() {
        return $this->employment_form;
    }

    public function get_change_of_residence() {
        return $this->change_of_residence;
    }

    public function get_salary() {
        return $this->salary;
    }

    public function get_status() {
        return $this->status;
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

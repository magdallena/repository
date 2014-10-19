<?php
include_once 'classDatabase.php';
class Application {

    private $mysqli;
    private $date;
    private $offer_id;
    private $student_id;
    private $cv;
    private $motivation_letter;

    function __construct() {
        $this->mysqli = new Database();
    }

    public static function make_new_to_add() {
        $obj = new Application();
        $obj->set_parameters();
        return $obj;
    }

    function set_parameters() {
        $this->student_id = $_POST['student_id'];
        $this->offer_id = $_POST['offer_id'];
        $date = new DateTime('now');
        $this->date = $date->format('Y-m-d');
    }

    function add_application() {
        if ($this->mysqli->check_application($this->student_id, $this->offer_id)) {
            echo "<h3>Już aplikowałeś na tę ofertę.</h3>";
        } else if ($this->check_file("cv") && $this->check_file("motivation_letter")) {
            $this->mysqli->insert_application($this);
            echo "<h3>Aplikacja została wysłana</h3>";
        }
    }

    function check_file($name) {
        $ok = true; 
        if ((($_FILES[$name]["type"] == "text/plain") || ($_FILES[$name]["type"] == "text/doc") || ($_FILES[$name]["type"] == "text/docx") || ($_FILES[$name]["type"] == "text/odt") || ($_FILES[$name]["type"] == "text/pdf")) && ($_FILES[$name]["size"] < 1000000)) {
            if ($_FILES[$name]["error"] > 0) {
                echo "<h3>Błędny plik: " . $_FILES[$name]["error"] . "</h3>";
                $ok = false;
            }

            $filename = basename($_FILES[$name]['name']);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $hour2 = new DateTime("now");
            $hour = $hour2->format("H-i");
            $newname = $name . "-" . $this->student_id . $this->date . '-' . $hour . '.' . $extension;
            $path = "../documents/" . $newname;
            $tmp_name = $_FILES[$name]['tmp_name'];
            if ($name == 'cv') {
                $this->cv = $newname;
            } else {
                $this->motivation_letter = $newname;
            }

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

    public function get_date() {
        return $this->date;
    }

    public function get_offer_id() {
        return $this->offer_id;
    }

    public function get_student_id() {
        return $this->student_id;
    }

    public function get_cv() {
        return $this->cv;
    }

    public function get_motivation_letter() {
        return $this->motivation_letter;
    }

}

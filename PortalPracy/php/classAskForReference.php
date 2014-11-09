<?php
include_once 'classDatabase.php';
class AskForReference {

    private $mysqli;
    private $student_id;
    private $teacher_id;
    private $date;
    private $message;

    function __construct() {
        $this->mysqli = new Database();
    }

    public static function make_new_to_send($student, $teacher) {
        $obj = new AskForReference();
        $obj->set_student_id($student);
        $obj->set_teacher_id($teacher);
        $obj->set_date();
        $obj->set_message();
        return $obj;
    }
    
    function send() {
        
        if($this->mysqli->check_request($this->student_id, $this->teacher_id)){
            echo "<h3>Nie można wysłać zapytania o referencje więcej niż jeden raz do tego samego nauczyciela</h3>";
        }
        else {
            $this->mysqli->insert_request($this);
            echo "<h3>Zapytanie o referencje zostało wysłane</h3>";
        }
        
    }
    
    
    public function set_student_id($student_id) {
        $this->student_id = $student_id;
    }

    public function set_teacher_id($teacher_id) {
        $this->teacher_id = $teacher_id;
    }

    public function set_date() {
        $date = new DateTime('now');
        $this->date = $date->format('Y-m-d');
    }
    
    public function set_message() {
        $this->message = addslashes(strip_tags(trim($_POST['message'])));
    }

        public function get_student_id() {
        return $this->student_id;
    }

    public function get_teacher_id() {
        return $this->teacher_id;
    }

    public function get_date() {
        return $this->date;
    }

    public function get_message() {
        return $this->message;
    }



}

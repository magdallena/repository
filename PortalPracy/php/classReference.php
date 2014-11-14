<?php
include_once 'classDatabase.php';
class Reference {

    private $mysqli;
    private $student_id;
    private $teacher_name;
    private $teacher_last_name;
    private $teacher_id;
    private $date;
    private $content;
    private $teacher_degree;

    function __construct() {
        $this->mysqli = new Database();
    }

    public static function make_new_to_display($teacher_id, $teacher_name, $teacher_last_name, $teacher_degree, $date, $content) {
        $obj = new Reference();
        $obj->set_teacher_id($teacher_id);
        $obj->set_teacher_name($teacher_name);
        $obj->set_teacher_last_name($teacher_last_name);
        $obj->set_teacher_degree($teacher_degree);
        $obj->set_date($date);
        $obj->set_content($content);
        return $obj;
    }

    public static function make_new_to_add() {
        $obj = new Reference();
        $obj->set_parameters();
        return $obj;
    }

    function display() {
        $string='';
        $string.= "<div class='commentbox'>";
        $string.= $this->content;
        $string.= "</div>";
        $string.= "<div class='commentfooter'>";
        $string.= "<a href='profile_teacher.php?id=" . $this->teacher_id . "'>" . $this->teacher_degree . " " . $this->teacher_name . " " . $this->teacher_last_name . "</a>, ";
        $string.= $this->date;
        $string.= "</div>";
        return $string;
    }

    function add() {
        if ($this->content == '') {
           $array[1]= 'Pusta odpowiedź';
        } else {
            $this->mysqli->insert_reference($this);
            $teacher_data = $this->mysqli->get_teacher_data($this->teacher_id);
            $this->set_teacher_name($teacher_data['name']);
            $this->set_teacher_last_name($teacher_data['last_name']);
            $this->set_teacher_degree($teacher_data['degree']);
            $array[0]= $this->display();
        }
        echo json_encode($array);
    }

    function set_parameters() {
        $this->student_id = $_POST['student_id'];
        $this->content = addslashes(strip_tags(trim($_POST['content'])));
        $this->teacher_id = $_POST['teacher_id'];
        $date = new DateTime('now');
        $this->date = $date->format('Y-m-d');
    }

    public function set_teacher_id($teacher_id) {
        $this->teacher_id = $teacher_id;
    }

    public function set_teacher_name($teacher_name) {
        $this->teacher_name = $teacher_name;
    }

    public function set_teacher_last_name($teacher_last_name) {
        $this->teacher_last_name = $teacher_last_name;
    }

    public function set_teacher_degree($teacher_degree) {
        $this->teacher_degree = $teacher_degree;
    }

    public function set_date($date) {
        $this->date = $date;
    }

    public function set_content($content) {
        $this->content = $content;
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

    public function get_content() {
        return $this->content;
    }


}

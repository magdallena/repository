<?php
include_once 'classDatabase.php';

class Comment {
    private $mysqli;
    private $student_id;
    private $student_name;
    private $student_last_name;
    private $company_id;
    private $date;
    private $content;
    private $rate;
    
    public static function make_new_to_display($student_id, $student_name, $student_last_name, $date, $content, $rate) {
        $obj = new Comment();
        $obj->set_student_id($student_id);
        $obj->set_student_name($student_name);
        $obj->set_student_last_name($student_last_name);
        $obj->set_date($date);
        $obj->set_content($content);
        $obj->set_rate($rate);
        return $obj;
    }
    
    function display() {
        $string='';
        $string.= "<div class='commentbox'>";
        $string.= $this->content;
        $string.= "</div>";
        $string.= "<div class='commentfooter'>";
        $string.= "<a href='profile_student.php?id=" . $this->student_id . "'>" . $this->student_name . " " . $this->student_last_name . "</a>, ";
        $string.= $this->date;
        $string.= ", ocena: ".$this->rate;
        $string.= "</div>";
        return $string;
    }
    
    
    public function set_student_id($student_id) {
        $this->student_id = $student_id;
    }

    public function set_student_name($student_name) {
        $this->student_name = $student_name;
    }

    public function set_student_last_name($student_last_name) {
        $this->student_last_name = $student_last_name;
    }

    public function set_date($date) {
        $this->date = $date;
    }

    public function set_content($content) {
        $this->content = $content;
    }

    public function set_rate($rate) {
        $this->rate = $rate;
    }


    
    
}

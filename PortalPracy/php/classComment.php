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

    function __construct() {
        $this->mysqli = new Database();
    }

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

    public static function make_new_to_add() {
        $obj = new Comment();
        $obj->set_parameters();
        return $obj;
    }

    public static function make_new_to_count_average($company_id) {
        $obj = new Comment();
        $obj->set_company_id($company_id);
        return $obj;
    }

    function add() {
        if ($this->content == '') {
            $array[1] = 'Pusta odpowiedź';
        } else if ($this->rate == 0) {
            $array[2] = 'Nie zaznaczono oceny';
        } else {

            $this->mysqli->insert_comment($this);
            $student_data = $this->mysqli->get_student_data($this->student_id);
            $this->set_student_name($student_data['name']);
            $this->set_student_last_name($student_data['last_name']);
            $array[0] = $this->display();
            $array[3] = $this->count_average();
            $array[4] = $this->count_number_of_votes();
        }
        echo json_encode($array);
    }

    function set_parameters() {
        $this->company_id = $_POST['company_id'];
        $this->content = addslashes(strip_tags(trim($_POST['content'])));
        $this->student_id = $_POST['student_id'];
        $this->rate = $_POST['rating'];
        $date = new DateTime('now');
        $this->date = $date->format('Y-m-d');
    }

    function display() {
        $string = '';
        $string.= "<div class='commentbox'>";
        $string.= $this->content;
        $string.= "</div>";
        $string.= "<div class='commentfooter'>";
        $string.= "<a href='profile_student.php?id=" . $this->student_id . "'>" . $this->student_name . " " . $this->student_last_name . "</a>, ";
        $string.= $this->date;
        $string.= ", ocena: " . $this->rate;
        $string.= "</div>";
        return $string;
    }

    function count_number_of_votes() {
        return $this->mysqli->get_comments_number($this->company_id);
    }

    function count_average(){
        $all=$this->count_number_of_votes();
        if($all==0) {
            $average=0;
        } else {
            $sum=0;
            $votes=$this->mysqli->get_comments_list(0, $all, $this->company_id);
            while ($obj = $votes->fetch_object()) {
                $sum+=$obj->rate;
            }
            $average=$sum/$all;
        }
        return round($average,2);
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

    public function set_company_id($company_id) {
        $this->company_id = $company_id;
    }

    public function get_student_id() {
        return $this->student_id;
    }

    public function get_company_id() {
        return $this->company_id;
    }

    public function get_date() {
        return $this->date;
    }

    public function get_content() {
        return $this->content;
    }

    public function get_rate() {
        return $this->rate;
    }

}

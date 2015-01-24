<?php

include_once 'classDatabase.php';

class Message {

    private $mysqli;
    private $student_from;
    private $teacher_from;
    private $company_from;
    private $student_to;
    private $teacher_to;
    private $company_to;
    private $content;
    private $datetime;
    private $read;
    private $id;

    function __construct() {
        $this->mysqli = new Database();
    }

    public static function make_new_to_send() {
        $obj = new Message();
        $obj->set_from();
        $obj->set_to();
        $obj->set_content_from_post();
        $obj->set_datetime_now();
        return $obj;
    }

    public static function make_new_to_display_sent($student_to, $teacher_to, $company_to, $content, $datetime) {
        $obj = new Message();
        $obj->set_student_to($student_to);
        $obj->set_teacher_to($teacher_to);
        $obj->set_company_to($company_to);
        $obj->set_content($content);
        $obj->set_datetime($datetime);
        return $obj;
    }

    public static function make_new_to_display_received($id, $student_from, $teacher_from, $company_from, $content, $datetime, $read) {
        $obj = new Message();
        $obj->set_student_from($student_from);
        $obj->set_teacher_from($teacher_from);
        $obj->set_company_from($company_from);
        $obj->set_content($content);
        $obj->set_datetime($datetime);
        $obj->set_read($read);
        $obj->set_id($id);
        return $obj;
    }

    function display_received() {
        if (!is_null($this->student_from)) {
            $s = $this->mysqli->get_student_data($this->student_from);
            $name = $s['name'];
            $last_name = $s['last_name'];
        } else if (!is_null($this->teacher_from)) {
            $t = $this->mysqli->get_teacher_data($this->teacher_from);
            $name = $t['name'];
            $last_name = $t['last_name'];
        } else if (!is_null($this->company_from)) {
            $c = $this->mysqli->get_company_data($this->company_from);
            $name = $c['name'];
            $last_name = '';
        }
        $string = "<div class='message'>";
        if ($this->read == 0) {
            $string.= "<div id='message$this->id' class='unread'>";
        } else {
            $string.= "<div>";
        }
        $string.="<span class='message_header'>";
        if ($this->read == 0) {
            $string.="<img id='icon$this->id' src='../images/message_icon.png' class='icon'/>";
        }
        $string.= "OD: " . $name . " " . $last_name . ", " . $this->datetime;
        if ($this->read == 0) {
            $string.="          <a id='read$this->id' onclick='mark_as_read(" . $this->id . ")'>oznacz jako przeczytane</a>";
        }
        $string.="</span><br/> ";
        $string.="<span class='message_content '>" . $this->content . "</span>";
        $string.="</div></div>";
        return $string;
    }

    function display_sent() {
        if (!is_null($this->student_to)) {
            $s = $this->mysqli->get_student_data($this->student_to);
            $name = $s['name'];
            $last_name = $s['last_name'];
        } else if (!is_null($this->teacher_to)) {
            $t = $this->mysqli->get_teacher_data($this->teacher_to);
            $name = $t['name'];
            $last_name = $t['last_name'];
        } else if (!is_null($this->company_to)) {
            $c = $this->mysqli->get_company_data($this->company_to);
            $name = $c['name'];
            $last_name = '';
        }
        $string = "<div class='message'>";
        $string.="<span class='message_header'>";
        $string.= "DO: " . $name . " " . $last_name . ", " . $this->datetime . "</span><br/> ";
        $string.="<span class='message_content '>" . $this->content . "</span>";
        $string.="</div>";
        return $string;
    }

    function send() {
        if ($_POST['recipient'] == '') {
            $array[1] = "nie wybrano adresata";
        } else if ($_POST['content'] == '') {
            $array[2] = 'pusta wiadomość';
        } else {
            if (!is_null($this->student_from) && !is_null($this->student_to)) {
                $this->mysqli->insert_message_ss($this);
            } else if (!is_null($this->student_from) && !is_null($this->teacher_to)) {
                $this->mysqli->insert_message_st($this);
            } else if (!is_null($this->student_from) && !is_null($this->company_to)) {
                $this->mysqli->insert_message_sc($this);
            } else if (!is_null($this->teacher_from) && !is_null($this->student_to)) {
                $this->mysqli->insert_message_ts($this);
            } else if (!is_null($this->teacher_from) && !is_null($this->teacher_to)) {
                $this->mysqli->insert_message_tt($this);
            } else if (!is_null($this->teacher_from) && !is_null($this->company_to)) {
                $this->mysqli->insert_message_tc($this);
            } else if (!is_null($this->company_from) && !is_null($this->student_to)) {
                $this->mysqli->insert_message_cs($this);
            } else if (!is_null($this->company_from) && !is_null($this->teacher_to)) {
                $this->mysqli->insert_message_ct($this);
            } else if (!is_null($this->company_from) && !is_null($this->company_to)) {
                $this->mysqli->insert_message_cc($this);
            }

            $array[0] = $this->display_sent();
            
            if(!is_null($this->student_to)) {
                $to = $this->mysqli->get_student_data($this->student_to)['email'];
            }
            if(!is_null($this->teacher_to)) {
                $to = $this->mysqli->get_student_data($this->teacher_to)['email'];
            }
            
            if(!is_null($this->company_to)) {
                $to = $this->mysqli->get_student_data($this->company_to)['email'];
            }
            
            if(!is_null($this->student_from)) {
                $student_data = $this->mysqli->get_student_data($this->student_from);
                $from = $student_data['name'] . ' ' . $student_data ['last_name'];
            }
            
            if(!is_null($this->teacher_from)) {
                $teacher_data = $this->mysqli->get_teacher_data($this->teacher_from);
                $from = $teacher_data['degree'] . ' ' . $teacher_data['name'] . ' ' . $teacher_data ['last_name'];
            }
            
            if(!is_null($this->company_from_from)) {
                $company_data = $this->mysqli->get_student_data($this->company_from);
                $from = $company_data['name'] ;
            }
            
            require_once("class.phpmailer.php");
            $email = new PHPMailer();
            $email->From      = 'portalpracydlastudentow@gmail.com';
            $email->FromName  = 'Portal Pracy';
            $email->Subject   = 'Nowa wiadomość';
            $email->Body      = "Otrzymałeś nową wiadomość\r\n"
                    . "OD: " . $from . "\r\n"
                    . $this->content;
            $email->AddAddress( $to );
            if( $email->Send()) {}
            
            
            
            
        }
        echo json_encode($array);
    }

    function set_from() {
        if (isset($_POST['student_id'])) {
            $this->student_from = $_POST['student_id'];
        } else if (isset($_POST['teacher_id'])) {
            $this->teacher_from = $_POST['teacher_id'];
        } if (isset($_POST['company_id'])) {
            $this->company_from = $_POST['company_id'];
        }
    }

    function set_to() {
        if (!($_POST['recipient']) == '') {
            $to = explode(";", $_POST['recipient']);
            if ($to[0] == 'student') {
                $this->student_to = $to[1];
            } else if ($to[0] == 'teacher') {
                $this->teacher_to = $to[1];
            } else if ($to[0] == 'company') {
                $this->company_to = $to[1];
            }
        }
    }

    function set_datetime_now() {
        $date = new DateTime('now');
        $this->datetime = $date->format('Y-m-d H:i:s');
    }

    function set_content_from_post() {
        $this->content = addslashes(strip_tags(trim($_POST['content'])));
    }

    public function get_student_from() {
        return $this->student_from;
    }

    public function get_teacher_from() {
        return $this->teacher_from;
    }

    public function get_company_from() {
        return $this->company_from;
    }

    public function get_student_to() {
        return $this->student_to;
    }

    public function get_teacher_to() {
        return $this->teacher_to;
    }

    public function get_company_to() {
        return $this->company_to;
    }

    public function get_content() {
        return $this->content;
    }

    public function get_datetime() {
        return $this->datetime;
    }

    public function set_student_from($student_from) {
        $this->student_from = $student_from;
    }

    public function set_teacher_from($teacher_from) {
        $this->teacher_from = $teacher_from;
    }

    public function set_company_from($company_from) {
        $this->company_from = $company_from;
    }

    public function set_student_to($student_to) {
        $this->student_to = $student_to;
    }

    public function set_teacher_to($teacher_to) {
        $this->teacher_to = $teacher_to;
    }

    public function set_company_to($company_to) {
        $this->company_to = $company_to;
    }

    public function set_content($content) {
        $this->content = $content;
    }

    public function set_datetime($datetime) {
        $this->datetime = $datetime;
    }

    public function set_read($read) {
        $this->read = $read;
    }

    public function set_id($id) {
        $this->id = $id;
    }

}

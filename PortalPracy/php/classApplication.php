<?php

include_once 'classDatabase.php';

class Application {

    private $mysqli;
    private $date;
    private $offer_id;
    private $student_id;
    private $cv;
    private $motivation_letter;
    private $response;
    private $id;
    private $response_date;

    function __construct() {
        $this->mysqli = new Database();
    }

    public static function make_new_to_add() {
        $obj = new Application();
        $obj->set_parameters();
        return $obj;
    }

    public static function make_new_to_send_response() {
        $obj = new Application();
        $obj->set_parameters_to_response();
        return $obj;
    }

    function set_parameters() {
        $this->student_id = $_POST['student_id'];
        $this->offer_id = $_POST['offer_id'];
        $date = new DateTime('now');
        $this->date = $date->format('Y-m-d');
    }

    function set_parameters_to_response() {
        $this->id = $_POST['application_id'];
        $this->response = addslashes(strip_tags(trim($_POST['response'])));
        $date = new DateTime('now');
        $this->response_date = $date->format('Y-m-d');
    }

    function add_application() {
        if ($this->mysqli->check_application($this->student_id, $this->offer_id)) {
            $array[1] = "Już aplikowałeś na tę ofertę.";
        } else if ($this->check_file("cv") && $this->check_file("motivation_letter")) {
            $this->mysqli->insert_application($this);
            
            $student_data = $this->mysqli->get_student_data($this->student_id);
            $offer_data = $this->mysqli->get_offer_data($this->offer_id)->fetch_object();
           
            require_once("class.phpmailer.php");
            $email = new PHPMailer();
            $email->From      = 'portalpracydlastudentow@gmail.com';
            $email->FromName  = 'Portal Pracy';
            $email->Subject   = 'Nowa aplikacja';
            $email->Body      = "Wysłano aplikację na twoją ofertę.\r\n"
                    . "OD:" . $student_data['name'] . ' ' . $student_data['last_name']
                    . "OFERTA: \r\n"
                    . "Stanowisko: " . $offer_data->job . "\r\n"
                    . "Numer telefonu: " . $this->telephone . "\r\n"
                    . "Sprawdź te dane i podejmij decyzję o aktywacji.";
            $email->AddAddress( $this->mysqli->get_company_data($offer_data->company_id)['email'] );
            $file_to_attach = '../documents/'.$this->cv;
            $email->AddAttachment( $file_to_attach );
            $file_to_attach2 = '../documents/'.$this->motivation_letter;
            $email->AddAttachment( $file_to_attach2 );
        if( $email->Send()) {}           
            
            
        } else {
            $array[2] = 'Niepoprawny plik (dostępne rozszerzenia: .txt, .docx, .doc, .pdf, .odt).';
        }
        $array[0] = $this->offer_id;
        echo json_encode($array);
    }

    function send_response() {
        if ($this->response == '') {
            $array[3] = 'Pusta odpowiedź';
        } else {
            $this->mysqli->update_application_with_response($this);
            $array[1] = $this->response;
            $array[2] = $this->response_date;
            
            $offer_data = $this->mysqli->get_offer_data($this->offer_id)->fetch_object();
            
            require_once("class.phpmailer.php");
            $email = new PHPMailer();
            $email->From      = 'portalpracydlastudentow@gmail.com';
            $email->FromName  = 'Portal Pracy';
            $email->Subject   = 'Odpowiedz na aplikacje';
            $email->Body      = "Otrzymałeś odpowiedź na twoją aplikację\r\n"
                    . "OFERTA \r\n"
                    . "Firma: " . $this->mysqli->get_company_data($offer_data->company_id)['name'] . "\r\n"
                    . "Stanowisko" . $offer_data->job . "\r\n\r\n"
                    . $this->response;
            $email->AddAddress( $this->mysqli->get_student_data($this->student_id)['email'] );
            if( $email->Send()) {}
            
            
        }
        $array[0] = $this->id;
        echo json_encode($array);
    }

    function check_file($name) {
        $ok = true;
        if ((($_FILES[$name]["type"] == "text/plain") || ($_FILES[$name]["type"] == "text/doc") || ($_FILES[$name]["type"] == "text/docx") || ($_FILES[$name]["type"] == "text/odt") || ($_FILES[$name]["type"] == "text/pdf")) && ($_FILES[$name]["size"] < 1000000)) {
            if ($_FILES[$name]["error"] > 0) {
//                echo "<h3>Błędny plik: " . $_FILES[$name]["error"] . "</h3>";
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
//                echo "<h3>Plik nie został wysłany</h3>";
                $ok = false;
            }
        } else {
//            echo "<h3>Niepoprawny plik.</h3>";
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

    public function get_response() {
        return $this->response;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_response_date() {
        return $this->response_date;
    }

}

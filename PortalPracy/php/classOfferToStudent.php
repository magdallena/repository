<?php

include_once 'classOffer.php';

class OfferToStudent extends Offer {

    private $student_id;
    private $date_send;
    private $response;
    private $date_response;

    function __construct() {
        parent::__construct();
    }

    public static function make_new_to_add($company_id) {
        $obj = new OfferToStudent();
        $obj->set_parameters($company_id);
        $obj->set_student_id();
        $obj->set_date_send();
        return $obj;
    }

    public static function make_new_to_response() {
        $obj = new OfferToStudent();
        $obj->set_offer_id();
        $obj->set_response();
        $obj->set_date_response();
        return $obj;
    }

    public function set_date_send() {
        $date = new DateTime('now');
        $this->date_send = $date->format('Y-m-d');
    }

    public function set_date_response() {
        $date = new DateTime('now');
        $this->date_response = $date->format('Y-m-d');
    }

    function set_student_id() {
        $this->student_id = $_POST['student_id'];
    }

    public function set_response() {
        $this->response = addslashes(strip_tags(trim($_POST['response'])));
    }

    function add_offer_to_student() {
        if (!$this->check_parameters()) {
            echo "<h2'><a href='add_offer.php?student=true'>Powrót do formularza dodania oferty</a></h2>";
        } else {
            $this->mysqli->insert_offer_to_student($this);
            echo "<h3'>Oferta została wysłana do studenta. <a href='index.php'>powrót</a></h3>";
        }
    }

    function send_response() {
        if ($this->response == '') {
            $array[1] = 'Pusta odpowiedź';
        } else if ($this->mysqli->check_response_to_offer($this->offer_id)) {
            $array[2] = '<h3>Już wysłałeś odpowiedź na tę ofertę.</h3>';
        } else {
            $this->mysqli->update_offer_to_student($this);
        }
        $array[0] = $this->offer_id;
        echo json_encode($array);
    }

    public function get_student_id() {
        return $this->student_id;
    }

    public function get_date_send() {
        return $this->date_send;
    }

    public function get_response() {
        return $this->response;
    }

    public function get_date_response() {
        return $this->date_response;
    }

}

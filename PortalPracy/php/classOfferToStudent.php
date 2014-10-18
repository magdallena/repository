<?php

include_once 'classOffer.php';

class OfferToStudent extends Offer{

    private $student_id;
    private $date_send;

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

    public function set_date_send() {
        $date = new DateTime('now');
        $this->date_send = $date->format('Y-m-d');
    }

    function set_student_id() {
        $this->student_id = $_POST['student_id'];
    }

    function add_offer_to_student() {
        if (!$this->check_parameters()) {
            echo "<h2'><a href='add_offer.php?student=true'>Powrót do formularza dodania oferty</a></h2>";
        } else {
            $this->mysqli->insert_offer_to_student($this);
            echo "<h3'>Oferta została wysłana do studenta.</h3>";
        }
    }

    public function get_student_id() {
        return $this->student_id;
    }

    public function get_date_send() {
        return $this->date_send;
    }

}

<?php

include_once 'classDatabase.php';

class Offer {

    protected $mysqli;
    protected $job;
    protected $description;
    protected $requirements;
    protected $place_of_work;
    protected $employment_status;
    protected $number_of_hours;
    protected $length_of_contract;
    protected $salary;
    protected $date_from;
    protected $date_to;
    protected $company_id;
    protected $offer_id;

    function __construct() {
        $this->mysqli = new Database();
    }

    public static function make_new_to_add($company_id) {
        $obj = new Offer();
        $obj->set_parameters($company_id);
        return $obj;
    }

    function set_parameters($company_id) {
        $this->job = addslashes(strip_tags(trim($_POST['job'])));
        $this->description = addslashes(strip_tags(trim($_POST['description'])));
        $this->requirements = addslashes(strip_tags(trim($_POST['requirements'])));
        $this->place_of_work = addslashes(strip_tags(trim($_POST['place_of_work'])));
        $this->employment_status = addslashes(strip_tags(trim($_POST['employment_status'])));
        $this->number_of_hours = addslashes(strip_tags(trim($_POST['number_of_hours'])));
        $this->length_of_contract = addslashes(strip_tags(trim($_POST['length_of_contract'])));
        $this->salary = addslashes(strip_tags(trim($_POST['salary'])));
        $this->date_from = addslashes(strip_tags(trim($_POST['date_from'])));
        $this->date_to = addslashes(strip_tags(trim($_POST['date_to'])));
        $this->company_id = $company_id;
    }

    public function set_offer_id() {
        $this->offer_id = $_POST['offer_id'];
    }

    function add_offer() {
        if (!$this->check_parameters()) {
            echo "<h2'><a href='add_offer.php'>Powrót do formularza dodania oferty</a></h2>";
        } else {
            $this->mysqli->insert_offer($this);
            echo "<h3'>Oferta została dodana.</h3>";
        }
    }

    function check_parameters() {
        $ok = true;
        if (!$this->check_job()) {
            $ok = false;
            echo "<h3>Brak stanowiska</h3>";
        }
        if (!$this->check_description()) {
            $ok = false;
            echo "<h3>Brak opisu oferty</h3>";
        }
        if (!$this->check_requirements()) {
            $ok = false;
            echo "<h3>Brak wymagań</h3>";
        }
        if (!$this->check_place_of_work()) {
            $ok = false;
            echo "<h3>Brak miejsc pracy</h3>";
        }
        if (!$this->check_number_of_hours()) {
            $ok = false;
            echo "<h3>Brak wymiatu pracy</h3>";
        }
        if (!$this->check_length_of_contract()) {
            $ok = false;
            echo "<h3>Brak długości umowy</h3>";
        }
        if (!$this->check_salary()) {
            $ok = false;
            echo "<h3>Brak wynagrodzenia</h3>";
        }
        if (!$this->check_date_from()) {
            $ok = false;
            echo "<h3>Brak daty początkowej ważności oferty</h3>";
        }
        if (!$this->check_date_to()) {
            $ok = false;
            echo "<h3>Brak daty końcowej ważności oferty</h3>";
        }
        return $ok;
    }

    function check_job() {
        $ok = true;
        if ($this->job == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_description() {
        $ok = true;
        if ($this->description == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_requirements() {
        $ok = true;
        if ($this->requirements == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_place_of_work() {
        $ok = true;
        if ($this->place_of_work == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_number_of_hours() {
        $ok = true;
        if ($this->number_of_hours == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_length_of_contract() {
        $ok = true;
        if ($this->length_of_contract == '') {
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

    function check_date_from() {
        $ok = true;
        if ($this->date_from == '') {
            $ok = false;
        }
        return $ok;
    }

    function check_date_to() {
        $ok = true;
        if ($this->date_to == '') {
            $ok = false;
        }
        return $ok;
    }

    public function get_job() {
        return $this->job;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_requirements() {
        return $this->requirements;
    }

    public function get_place_of_work() {
        return $this->place_of_work;
    }

    public function get_employment_status() {
        return $this->employment_status;
    }

    public function get_number_of_hours() {
        return $this->number_of_hours;
    }

    public function get_length_of_contract() {
        return $this->length_of_contract;
    }

    public function get_salary() {
        return $this->salary;
    }

    public function get_date_from() {
        return $this->date_from;
    }

    public function get_date_to() {
        return $this->date_to;
    }

    public function get_company_id() {
        return $this->company_id;
    }

    public function get_offer_id() {
        return $this->offer_id;
    }

}

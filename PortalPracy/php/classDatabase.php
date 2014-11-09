<?php

include_once 'classStudent.php';

class Database {

    private $db;
    private $server;
    private $user;
    private $password;
    private $basename;

    function __construct() {
        $this->server = 'localhost';
        $this->user = 'root';
        $this->password = '';
        $this->basename = 'data_base';
        $this->db = new mysqli($this->server, $this->user, $this->password, $this->basename);
        if ($this->db->connect_error) {
            die('Blad polaczenia z baza danych (' . $this->db->connect_errno . ') ' . $this->db->connect_error);
        } else {
            $this->db->query("SET NAMES 'utf8'");
        }
    }

    function __destruct() {
        $this->db->close();
    }

    function check_student($email, $password) {
        if ($result = $this->db->query("SELECT * FROM `student` WHERE `e_mail`='$email' and `password`='$password'")) {
            if ($result->num_rows == 0) {
                $result->close();
                return false;
            } else {
                $result->close();
                return true;
            }
        }
    }

    function check_teacher($email, $password) {
        if ($result = $this->db->query("SELECT * FROM `teacher` WHERE `e_mail`='$email' and `password`='$password'")) {
            if ($result->num_rows == 0) {
                $result->close();
                return false;
            } else {
                $result->close();
                return true;
            }
        }
    }

    function check_company($email, $password) {
        if ($result = $this->db->query("SELECT * FROM `company` WHERE `e_mail`='$email' and `password`='$password'")) {
            if ($result->num_rows == 0) {
                $result->close();
                return false;
            } else {
                $result->close();
                return true;
            }
        }
    }

    function check_admin($email) {
        if ($result = $this->db->query("SELECT `is_admin` FROM `student` WHERE `e_mail`='$email'")) {
            $obj = $result->fetch_object();
            return $obj->is_admin;
        }
    }

    function check_teacher_active($email) {
        if ($result = $this->db->query("SELECT `active` FROM `teacher` WHERE `e_mail`='$email'")) {
            $obj = $result->fetch_object();
            return $obj->active;
        }
    }

    function check_company_active($email) {
        if ($result = $this->db->query("SELECT `active` FROM `company` WHERE `e_mail`='$email'")) {
            $obj = $result->fetch_object();
            return $obj->active;
        }
    }

    function check_student_email($email) {
        if ($result = $this->db->query("SELECT `e_mail` FROM `student` WHERE `e_mail`='$email'")) {
            if ($result->num_rows == 0) {
                $result->close();
                return false;
            } else {
                $result->close();
                return true;
            }
        }
    }

    function check_teacher_email($email) {
        if ($result = $this->db->query("SELECT `e_mail` FROM `teacher` WHERE `e_mail`='$email'")) {
            if ($result->num_rows == 0) {
                $result->close();
                return false;
            } else {
                $result->close();
                return true;
            }
        }
    }

    function check_company_email($email) {
        if ($result = $this->db->query("SELECT `e_mail` FROM `company` WHERE `e_mail`='$email'")) {
            if ($result->num_rows == 0) {
                $result->close();
                return false;
            } else {
                $result->close();
                return true;
            }
        }
    }

    function insert_student($student) {
        $stmt = $this->db->prepare("INSERT INTO `student` VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'0',?)");
        $stmt->bind_param('sssissssssssiisss', $student->get_name(), $student->get_last_name(), $student->get_address(), $student->get_telephone(), $student->get_email(), $student->get_password(), $student->get_education(), $student->get_languages(), $student->get_experience(), $student->get_skills(), $student->get_interest(), $student->get_employment_form(), $student->get_change_of_residence(), $student->get_salary(), $student->get_status(), $student->get_date(), $student->get_photo());
        $stmt->execute();
        $stmt->close();
    }

    function insert_teacher($teacher) {
        $stmt = $this->db->prepare("INSERT INTO `teacher` VALUES(NULL,?,?,?,?,?,?,'0',?)");
        $stmt->bind_param('sssisss', $teacher->get_name(), $teacher->get_last_name(), $teacher->get_degree(), $teacher->get_telephone(), $teacher->get_email(), $teacher->get_password(), $teacher->get_date());
        $stmt->execute();
        $stmt->close();
    }

    function insert_company($company) {
        $stmt = $this->db->prepare("INSERT INTO `company` VALUES(NULL,?,?,?,?,?,'0',?,?)");
        $stmt->bind_param('ssisss', $company->get_name(), $company->get_address(), $company->get_telephone(), $company->get_email(), $company->get_password(), $company->get_date(), $company->get_photo());
        $stmt->execute();
        $stmt->close();
    }

    function get_admin_email() {
        if ($result = $this->db->query("SELECT `e_mail` FROM `student` WHERE `is_admin`='1'")) {
            $obj = $result->fetch_object();
            return $obj->e_mail;
        }
    }

    function get_student_data($id) {
        if ($result = $this->db->query("SELECT * FROM `student` WHERE `student_id`='$id'")) {
            if ($result->num_rows == 0) {
                return false;
            } else {
                $obj = $result->fetch_object();
                $array = array();
                $array['name'] = $obj->name;
                $array['last_name'] = $obj->last_name;
                $array['address'] = $obj->address;
                $array['telephone'] = $obj->telephone;
                $array['education'] = $obj->education;
                $array['languages'] = $obj->languages;
                $array['experience'] = $obj->experience;
                $array['skills'] = $obj->skills;
                $array['interest'] = $obj->interest;
                $array['employment_form'] = $obj->employment_form;
                $array['change_of_residence'] = $obj->change_of_residence;
                $array['salary'] = $obj->salary;
                $array['status'] = $obj->status;
                $array['photoname'] = $obj->photoname;
                return $array;
            }
        }
    }

    function get_teacher_data($id) {
        if ($result = $this->db->query("SELECT * FROM `teacher` WHERE `teacher_id`='$id'")) {
            if ($result->num_rows == 0) {
                return false;
            } else {
                $obj = $result->fetch_object();
                $array = array();
                $array['name'] = $obj->name;
                $array['last_name'] = $obj->last_name;
                $array['degree'] = $obj->academic_degree;
                $array['telephone'] = $obj->telephone;
                return $array;
            }
        }
    }

    function get_company_data($id) {
        if ($result = $this->db->query("SELECT * FROM `company` WHERE `company_id`='$id'")) {
            if ($result->num_rows == 0) {
                return false;
            } else {
                $obj = $result->fetch_object();
                $array = array();
                $array['name'] = $obj->name;
                $array['address'] = $obj->address;
                $array['telephone'] = $obj->telephone;
                $array['photoname'] = $obj->photoname;
                return $array;
            }
        }
    }

    function update_student($student) {
        $stmt = $this->db->prepare("UPDATE `student` SET name = ?, last_name = ?, address = ?, telephone = ?, 
                    education = ?, languages = ?, experience = ?, skills = ?, interest = ?, employment_form = ?,
                    change_of_residence = ?,salary = ?, status = ?  WHERE `e_mail` = ?");
        $stmt->bind_param('sssissssssisss', $student->get_name(), $student->get_last_name(), $student->get_address(), $student->get_telephone(), $student->get_education(), $student->get_languages(), $student->get_experience(), $student->get_skills(), $student->get_interest(), $student->get_employment_form(), $student->get_change_of_residence(), $student->get_salary(), $student->get_status(), $student->get_email());
        $stmt->execute();
        $stmt->close();
    }

    function update_student_password($student) {
        $stmt = $this->db->prepare("UPDATE `student` SET password = ? WHERE `e_mail` = ?");
        $stmt->bind_param('ss', $student->get_password(), $student->get_email());
        $stmt->execute();
        $stmt->close();
    }

    function update_teacher($teacher) {
        $stmt = $this->db->prepare("UPDATE `teacher` SET name = ?, last_name = ?, academic_degree = ?, telephone = ?  WHERE `e_mail` = ?");
        $stmt->bind_param('sssss', $teacher->get_name(), $teacher->get_last_name(), $teacher->get_degree(), $teacher->get_telephone(), $teacher->get_email());
        $stmt->execute();
        $stmt->close();
    }

    function update_teacher_password($teacher) {
        $stmt = $this->db->prepare("UPDATE `teacher` SET password = ? WHERE `e_mail` = ?");
        $stmt->bind_param('ss', $teacher->get_password(), $teacher->get_email());
        $stmt->execute();
        $stmt->close();
    }

    function update_company($company) {
        $stmt = $this->db->prepare("UPDATE `company` SET name = ?, address = ?, telephone = ?  WHERE `e_mail` = ?");
        $stmt->bind_param('ssss', $company->get_name(), $company->get_address(), $company->get_telephone(), $company->get_email());
        $stmt->execute();
        $stmt->close();
    }

    function update_company_password($company) {
        $stmt = $this->db->prepare("UPDATE `company` SET password = ? WHERE `e_mail` = ?");
        $stmt->bind_param('ss', $company->get_password(), $company->get_email());
        $stmt->execute();
        $stmt->close();
    }

    function update_student_photo($student) {
        $stmt = $this->db->prepare("UPDATE `student` SET photoname = ? WHERE `student_id` = ?");
        $stmt->bind_param('ss', $student->get_photo(), $student->get_id());
        $stmt->execute();
        $stmt->close();
    }

    function update_company_photo($company) {
        $stmt = $this->db->prepare("UPDATE `company` SET photoname = ? WHERE `company_id` = ?");
        $stmt->bind_param('ss', $company->get_photo(), $company->get_id());
        $stmt->execute();
        $stmt->close();
    }

    function get_student_id($email) {
        if ($result = $this->db->query("SELECT `student_id` FROM `student` WHERE `e_mail`='$email'")) {
            $obj = $result->fetch_object();
            return $obj->student_id;
        }
    }

    function get_teacher_id($email) {
        if ($result = $this->db->query("SELECT `teacher_id` FROM `teacher` WHERE `e_mail`='$email'")) {
            $obj = $result->fetch_object();
            return $obj->teacher_id;
        }
    }

    function get_company_id($email) {
        if ($result = $this->db->query("SELECT `company_id` FROM `company` WHERE `e_mail`='$email'")) {
            $obj = $result->fetch_object();
            return $obj->company_id;
        }
    }

    function get_student_photo($id) {
        if ($result = $this->db->query("SELECT `photoname` FROM `student` WHERE `student_id`='$id'")) {
            $obj = $result->fetch_object();
            return $obj->photoname;
        }
    }

    function get_student_last_name($id) {
        if ($result = $this->db->query("SELECT `last_name` FROM `student` WHERE `student_id`='$id'")) {
            $obj = $result->fetch_object();
            return $obj->last_name;
        }
    }

    function get_company_photo($id) {
        if ($result = $this->db->query("SELECT `photoname` FROM `company` WHERE `company_id`='$id'")) {
            $obj = $result->fetch_object();
            return $obj->photoname;
        }
    }

    function get_company_name($id) {
        if ($result = $this->db->query("SELECT `name` FROM `company` WHERE `company_id`='$id'")) {
            $obj = $result->fetch_object();
            return $obj->name;
        }
    }

    function get_student_list($start, $onpage) {
        if ($result = $this->db->query("SELECT * FROM `student` ORDER BY `last_name` LIMIT $start, $onpage ")) {
            return $result;
        }
    }

    function get_student_number() {
        if ($result = $this->db->query("SELECT * FROM `student`")) {
            $all = $result->num_rows;
            $result->close();
        }
        return $all;
    }

    function get_teacher_list($start, $onpage) {
        if ($result = $this->db->query("SELECT * FROM `teacher` ORDER BY `last_name` LIMIT $start, $onpage")) {
            return $result;
        }
    }

    function get_teacher_number() {
        if ($result = $this->db->query("SELECT * FROM `teacher`")) {
            $all = $result->num_rows;
            $result->close();
        }
        return $all;
    }

    function get_company_list($start, $onpage) {
        if ($result = $this->db->query("SELECT * FROM `company` LIMIT $start, $onpage")) {
            return $result;
        }
    }

    function get_company_number() {
        if ($result = $this->db->query("SELECT * FROM `company`")) {
            $all = $result->num_rows;
            $result->close();
        }
        return $all;
    }

    function insert_offer($offer) {
        $stmt = $this->db->prepare("INSERT INTO `offer` VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('isssssisiss', $offer->get_company_id(), $offer->get_job(), $offer->get_description(), $offer->get_requirements(), $offer->get_place_of_work(), $offer->get_employment_status(), $offer->get_number_of_hours(), $offer->get_length_of_contract(), $offer->get_salary(), $offer->get_date_from(), $offer->get_date_to());
        $stmt->execute();
        $stmt->close();
    }

    function insert_offer_to_student($offer) {
        $stmt = $this->db->prepare("INSERT INTO `offer_to_student` VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?,?,?, NULL, NULL)");
        $stmt->bind_param('iisssssisisss', $offer->get_company_id(), $offer->get_student_id(), $offer->get_job(), $offer->get_description(), $offer->get_requirements(), $offer->get_place_of_work(), $offer->get_employment_status(), $offer->get_number_of_hours(), $offer->get_length_of_contract(), $offer->get_salary(), $offer->get_date_from(), $offer->get_date_to(), $offer->get_date_send());
        $stmt->execute();
        $stmt->close();
    }

    function check_request($student, $teacher) {
        if ($result = $this->db->query("SELECT * FROM `ask_for_reference` WHERE `student_id`='$student' and `teacher_id`='$teacher' AND `status`=0")) {
            if ($result->num_rows == 0) {
                $result->close();
                return false;
            } else {
                $result->close();
                return true;
            }
        }
    }

    function insert_request($request) {
        $stmt = $this->db->prepare("INSERT INTO `ask_for_reference` VALUES(NULL,?,?,?,?,0)");
        $stmt->bind_param('iiss', $request->get_student_id(), $request->get_teacher_id(), $request->get_message(), $request->get_date());
        $stmt->execute();
        $stmt->close();
    }

    function get_asks_for_reference($teacher_id) {
        if ($result = $this->db->query("SELECT * FROM `ask_for_reference` a JOIN `student` s ON a.`student_id`=s.`student_id` WHERE `teacher_id`='$teacher_id' AND a.`status`='0' ORDER BY `date` DESC")) {
            return $result;
        } 
    }

    function get_offer_to_student($student_id) {
        if ($result = $this->db->query("SELECT * FROM `offer_to_student` o JOIN `company` c ON o.`company_id`=c.`company_id` "
                . "WHERE `student_id`='$student_id' AND curdate( ) BETWEEN `date_from` AND `date_to` ORDER BY `date_to`")) {
            return $result;
        }
    }

    function get_offer() {
        if ($result = $this->db->query("SELECT * FROM `offer` o JOIN `company` c ON o.`company_id`=c.`company_id` "
                . "WHERE curdate( ) BETWEEN `date_from` AND `date_to` ORDER BY `date_to`")) {
            return $result;
        }
    }

    function check_response_to_offer($offer_id) {
        if ($result = $this->db->query("SELECT `response` FROM `offer_to_student` WHERE `offer_to_id`='$offer_id'")) {
            $obj = $result->fetch_object();
            if ($obj->response == NULL) {
                return false;
            } else {
                return true;
            }
        }
    }

    function update_offer_to_student($offer) {
        $stmt = $this->db->prepare("UPDATE `offer_to_student` SET `response` = ?, `response_date` = ? WHERE `offer_to_id` = ?");
        $stmt->bind_param('ssi', $offer->get_response(), $offer->get_date_response(), $offer->get_offer_id());
        $stmt->execute();
        $stmt->close();
    }

    function get_application_data_for_student($student_id, $offer_id) {
        if ($result = $this->db->query("SELECT * FROM `application` WHERE `student_id`='$student_id' AND `offer_id`='$offer_id'")) {
            return $result;
        }
    }

    function insert_application($application) {
        $stmt = $this->db->prepare("INSERT INTO `application` VALUES(NULL,?,?,?,0,?,?, NULL, NULL)");
        $stmt->bind_param('iisss', $application->get_offer_id(), $application->get_student_id(), $application->get_date(), $application->get_cv(), $application->get_motivation_letter());
        $stmt->execute();
        $stmt->close();
    }

    function get_offer_to_student_for_company($company_id) {
        if ($result = $this->db->query("SELECT * FROM `offer_to_student` o JOIN `student` s ON o.`student_id`=s.`student_id` "
                . "WHERE `company_id`='$company_id' ORDER BY `date_send` DESC")) {
            return $result;
        }
    }

    function get_offer_for_company($company_id) {
        if ($result = $this->db->query("SELECT * FROM `offer` WHERE `company_id`='$company_id' ORDER BY `date_from` DESC")) {
            return $result;
        }
    }

    function get_number_of_application($offer_id) {
        if ($result = $this->db->query("SELECT * FROM `application` WHERE `offer_id`='$offer_id'")) {
            return $result->num_rows;
        }
    }

    function get_number_of_offers() {
        if ($result = $this->db->query("SELECT * FROM `offer`")) {
            return $result->num_rows;
        }
    }

    function check_offer_with_company($offer_id, $company_id) {
        if ($result = $this->db->query("SELECT * FROM `offer` WHERE `company_id`='$company_id' AND `offer_id`='$offer_id'")) {
            if ($result->num_rows == 0) {
                $result->close();
                return false;
            } else {
                $result->close();
                return true;
            }
        }
    }

    function get_application_data($offer_id, $start, $onpage) {
        if ($result = $this->db->query("SELECT * FROM `application` a JOIN `offer` o ON o.`offer_id`=a.`offer_id` "
                . "JOIN `student` s ON s.`student_id`=a.`student_id` WHERE a.`offer_id`='$offer_id' ORDER BY `date` LIMIT $start, $onpage")) {

            return $result;
        } else
            echo "niepoprawne zapytanie";
    }

    function update_ask_status($ask_id) {
        if ($result = $this->db->query("UPDATE `ask_for_reference` SET `status` = '1' WHERE `ask_id` = " . $ask_id)) {
            
        }
    }

    function update_application_with_response($app) {
        $stmt = $this->db->prepare("UPDATE `application` SET response = ?, response_date = ?  WHERE `application_id` = ?");
        $stmt->bind_param('ssi', $app->get_response(), $app->get_response_date(), $app->get_id());
        $stmt->execute();
        $stmt->close();
    }

    function check_application($student, $offer) {
        if ($result = $this->db->query("SELECT * FROM `application` WHERE `student_id`='$student' and `offer_id`='$offer' ")) {
            if ($result->num_rows == 0) {
                $result->close();
                return false;
            } else {
                $result->close();
                return true;
            }
        }
    }

    function get_references_list($start, $onpage, $id) {
        if ($result = $this->db->query("SELECT * FROM `references` WHERE `student_id`=$id LIMIT $start, $onpage")) {
            return $result;
        }
    }

    function get_references_number() {
        if ($result = $this->db->query("SELECT * FROM `references`")) {
            $all_refs = $result->num_rows;
            $result->close();
        } else
            echo "na nic to zapytanie jest";
        return $all_refs;
    }

}

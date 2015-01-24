<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
error_reporting(0);

if (!isset($_GET['ask_id'])) { 
    echo 'false';
    exit;
}
$id =$_GET['ask_id'];
include_once 'classDatabase.php';
$db=new Database();
$db->update_ask_status($id);

//TO DO wysłać maila do studenta o zignorowaniu prośby
$result = $db->get_asks_for_reference_data($id);
$obj = $result->fetch_object();



if(!$db->check_references_student_with_teacher($obj->student_id, $obj->teacher_id)) {
    $email = new PHPMailer();
    $email->From      = 'portalpracydlastudentow@gmail.com';
    $email->FromName  = 'Portal Pracy';
    $email->Subject   = 'Prosba o referencje';
    $email->Body      = 'Twoja prośba o referencje wysłana \r\ndo: ' 
            . $teacher['degree'] . ' ' . $teacher['name'] . ' ' . $teacher['last_name'] . '\r\n'
            . 'dnia: ' . $obj->date . '\r\n'
            . 'o treści: ' . $obj->content . '\r\n'
            . 'została zignorowana.';
    $email->AddAddress( $db->get_student_data($obj->student_id)['email'] );
    if( $email->Send()) {}
    
}





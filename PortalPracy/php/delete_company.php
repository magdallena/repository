<?php
if(isset($_SESSION['name'])) {
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    error_reporting(0);

    if (!isset($_GET['id'])) { 
        echo 'false';
        exit;
    }

    $id =$_GET['id'];
    include_once 'classDatabase.php';
    $db = new Database();

    $email = new PHPMailer();
    $email->From      = 'portalpracydlastudentow@gmail.com';
    $email->FromName  = 'Portal Pracy';
    $email->Subject   = 'Twoje konto usuniete';
    $email->Body      = 'Twoje konto na portalu pracy dla studentów zostało usunięte przez administratora.';
    $email->AddAddress( $db->get_company_data($id)['email'] );
    if( $email->Send()) {}

    $db->delete_company($id);
}
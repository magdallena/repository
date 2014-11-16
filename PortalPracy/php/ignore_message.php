<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
error_reporting(0);

if (!isset($_GET['mes_id'])) { 
    echo 'false';
    exit;
}
$id =$_GET['mes_id'];
include_once 'classDatabase.php';
$db=new Database();
$db->update_message_read($id);




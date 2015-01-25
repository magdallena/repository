<?php
if(isset($_SESSION['name'])) {
    include_once 'classReference.php';
    $ref = Reference :: make_new_to_add();
    $ref->add();
}
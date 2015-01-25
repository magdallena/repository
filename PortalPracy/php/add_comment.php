<?php
if(isset($_SESSION['name'])) {
    include_once 'classComment.php';
    $com = Comment :: make_new_to_add();
    $com->add();
}

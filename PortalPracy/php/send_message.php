<?php

if (isset($_SESSION['name'])) {
    include_once 'classMessage.php';
    $m = Message :: make_new_to_send();
    $m->send();
}

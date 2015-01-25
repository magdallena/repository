<?php

if (isset($_SESSION['name'])) {
    include_once 'classOfferToStudent.php';
    $soffer = OfferToStudent::make_new_to_response();
    $soffer->send_response();
}
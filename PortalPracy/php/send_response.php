<?php

include_once 'classOfferToStudent.php';
$soffer = OfferToStudent::make_new_to_response();
$soffer->send_response();

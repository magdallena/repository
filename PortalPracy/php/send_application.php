<?php

if (isset($_SESSION['name'])) {
    include_once 'classApplication.php';
    $app = Application::make_new_to_add();
    $app->add_application();
}

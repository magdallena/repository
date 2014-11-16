<?php

if (isset($_REQUEST['q']) && isset($_REQUEST['id'])) { 
    $student= $_REQUEST['id'];
    include_once 'classDatabase.php';
    $db = new Database();
    $result = $db->get_offer_to_added_list($student, 0, $db->get_offer_to_added_number($student));
    $a = array();
    $i = 0;
    while ($obj = $result->fetch_object()) {
        $a[$obj->offer_to_id] = $obj->job . ", " . $obj->date_send;
        $i++;
    } 
    $q = $_REQUEST["q"];
    $hint = "";

// lookup all hints from array if $q is different from ""
    if ($q !== "") {
        $q = strtolower($q);
        $len = strlen($q);
        foreach ($a as $id => $name) {
            if (stristr($q, substr($name, 0, $len))) {
                if ($hint === "") {
                    $hint = "<a href='offer_to_description.php?id=" . $id . "'>" . $name . "</a>";
                } else {
                    $hint .= "<br/><a href='offer_to_description.php?id=" . $id . "'>" . $name . "</a>";
                }
            }
        }
    }

// Output "no suggestion" if no hint was found
// or output the correct values
    echo $hint === "" ? "brak wyników" : $hint;
}
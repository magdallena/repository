<?php

include_once 'classDatabase.php';
$db = new Database();
$result = $db->get_teacher_list(0, $db->get_teacher_number());
$a = array();
$i = 0;
while ($obj = $result->fetch_object()) {
    $a[$obj->teacher_id] = $obj->academic_degree . " " . $obj->last_name . " " . $obj->name;
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
                $hint="<a href='profile_teacher.php?id=" . $id . "'>".$name."</a>";
            } else {
                $hint .= "<br/><a href='profile_teacher.php?id=" . $id . "'>".$name."</a>";
            }
        }
    }
}

// Output "no suggestion" if no hint was found
// or output the correct values
echo $hint === "" ? "brak wyników" : $hint;


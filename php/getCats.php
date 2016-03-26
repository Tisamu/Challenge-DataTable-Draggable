<?php

require("../db/database.class.php");

$db = new Database();

$db->query('SELECT * FROM tabcat');

$rows = $db->resultset();

foreach($rows as $key => $value){
    $tab[] = array("idcat" => utf8_encode($value["idcat"]), "nomcat" => utf8_encode($value["nomcat"]));
}

echo json_encode($tab);
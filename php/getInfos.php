<?php
require("../db/database.class.php");

$db = new Database();

$db->query('SELECT idinfo,idcat,titleinfo,info FROM tabinfos');
$infos = $db->resultset();

foreach($infos as $key => $info){
    $db->query('SELECT nomcat FROM tabcat WHERE idcat = :id');
    $db->bind(':id', $info['idcat']);
    $infos[$key]['idcat'] = $db->single()['nomcat'];
    $infos[$key]['titleinfo'] = $infos[$key]['titleinfo'];
    $infos[$key]['info'] = $infos[$key]['info'];

}

echo json_encode($infos);
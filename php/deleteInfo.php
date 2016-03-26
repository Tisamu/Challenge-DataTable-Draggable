<?php

require('../db/database.class.php');

$db = new Database();

$db->query('DELETE FROM tabinfos WHERE idinfo = :id');
$db->bind(':id', $_POST['idinfo']);

$db->execute();
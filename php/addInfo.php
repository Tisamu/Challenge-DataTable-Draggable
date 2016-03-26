<?php

require('../db/database.class.php');

$db = new Database();

$db->query('INSERT INTO tabinfos (idcat,titleinfo,info,enable) VALUES (:idcat, :title, :info, 0)');
$db->bind(':idcat', $_POST['category']);
$db->bind(':title', $_POST['title']);
$db->bind(':info', $_POST['info']);

$db->execute();

echo $db->lastInsertId();
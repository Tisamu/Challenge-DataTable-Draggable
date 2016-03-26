<?php

require('../db/database.class.php');

$db = new Database();

$db->query('INSERT INTO tabcat (nomcat) VALUES (:cat)');
$db->bind(':cat', $_POST['category']);

$db->execute();

echo $db->lastInsertId();
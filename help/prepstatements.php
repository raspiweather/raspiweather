<?php

$dbh = new PDO("mysql:host=$database['host'];dbname=$database['name']", $database['user'], $database['pass']);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $dbh->prepare("INSERT INTO users (username, pass ) VALUES (:phpro_username, :phpro_password )");

$stmt->bindParam(':phpro_username', $phpro_username, PDO::PARAM_STR);
$stmt->bindParam(':phpro_password', $phpro_password, PDO::PARAM_STR, 40);

$stmt->execute();

?>
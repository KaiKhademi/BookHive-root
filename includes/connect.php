<?php

$host = "localhost";
$dbname = "my_database";
$username = "root"; // Default for XAMPP/WAMP
$password = ""; // Empty password for local setup

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
<?php

include('../config/config.php');

try {
    // Create PDO connection
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If there's an error, catch it and display a message
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>

<?php
// Database connection variables
$host = '127.0.0.1'; // localhost
$dbname = 'bookhive_db'; // your database name
$username = 'root'; // default MySQL username for XAMPP
$password = ''; // default MySQL password for XAMPP (empty by default)

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If there's an error, catch it and display a message
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>

<?php
// Include the database connection
global $pdo;
include('connect.php'); // Make sure 'connect.php' contains the correct PDO connection

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query to find the user by email
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR); // Bind the email parameter securely
    $stmt->execute();

    // Fetch the user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and password matches
    if ($password === $user['password']) {
        echo "Success"; // Successful login
    } else {
        echo "Error"; // Invalid email or password
    }
}
?>

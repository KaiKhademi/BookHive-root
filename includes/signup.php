<?php
// Include the database connection
global $pdo;
include('connect.php'); // Ensure 'connect.php' contains the correct PDO connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob']; // Date of Birth

    // Check if the email or username already exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the email or username already exists, display an error message
    if ($user) {
        echo "Error: Email or Username already in use!";
    } else {try {

        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, dob) VALUES (:username, :email, :password, :dob)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':dob', $dob);

        // Execute the query
        if ($stmt->execute()) {
            echo "User registered successfully!";
            // Optionally, redirect to the login page after registration
            header('Location: signin.html');
            exit();
        } else {
            echo "Error: Something went wrong!";
        }
    }catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    }
}
?>

<?php
session_start(); // Start the session on the protected page

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header('Location: ../public/index.html');
    exit();
}
// Include the database connection
global $pdo;
include('connect.php'); // Ensure 'connect.php' contains the correct PDO connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_SESSION['username'];
    $book = $_POST['book_name'];
    $content = $_POST['message'];
    $userTime = $_POST['user_time'];

    try {
        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO Threads (username, book, content, date) VALUES (:username, :book, :content, :date)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':book', $book);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':date', $userTime);

        // Execute the query
        if ($stmt->execute()) {
            echo "Thread added successfully!";

            header('Location: ../public/threads.php');
            exit();
        } else {
            echo "Error: Something went wrong!";
        }
    }catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}
?>


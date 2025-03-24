<?php
session_start(); // Start the session on the protected page

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
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
    $genre = $_POST['genre'];

    // Check if the email or username already exists in the database
    $stmt = $pdo->prepare("SELECT * FROM Books WHERE owner_username = :username AND book_name = :book AND genre = :genre");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':book', $book);
    $stmt->bindParam(':genre', $genre);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the email or username already exists, display an error message
    if ($user) {
        echo "Error: You have already added this book.";
    } else {try {
        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO Books (book_name, genre, owner_username) VALUES (:book, :genre, :username)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':book', $book);
        $stmt->bindParam(':genre', $genre);

        // Execute the query
        if ($stmt->execute()) {
            echo "Book added successfully!";

            header('Location: ../public/home.php');
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


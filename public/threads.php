<?php
session_start(); // Start the session on the protected page

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header('Location: index.html');
    exit();
}
global $pdo;
include("../includes/connect.php");
$username = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT * FROM Threads WHERE username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$threads = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHive</title>
    <link rel="stylesheet" href="css/starter.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="topbar">
    <img class ="icon" src="images/BookHive-Logo.png"/>
    <h1>BookHive</h1>
</header>
<nav class="navbar">
    <ul class="nav-links">
        <li><a href="home.php">Home</a></li>
        <li><a href="hive.html">Hive</a></li>
        <li><a href="threads.php">Threads</a></li>
        <li><a href="about.html">About</a></li>
        <input type="text" class="search-box" placeholder="Search...">
        <button class="search-button">Search</button>
    </ul>
</nav>
<br>
<div class="dashboard">
    <div class="threads">
        <div class="achievments">
            <h2>Achievments</h2>
            <div class="item">
                <img src="images/achievment-logo.png" alt="achivement" class="icon">
                <span class="caption">Logging in!</span>
            </div>
        </div>
        <div class="shelf">
            <div class="myThreads" id="myThreads">
                <h2>My Threads</h2>
                <?php
                foreach ($threads as $thread) {
                    $thread_owner = $thread["username"];
                    $thread_book = $thread["book"];
                    $thread_content = $thread["content"];
                    echo '<div class="item">
                                      <h2 >' . $thread_owner . '</h2>
                                      <h3>'.$thread_book.'</h3>
                                      <p>'.$thread_content.'</p>
                                    </div>';
                }
                ?>
                <form action="../includes/add_thread.php" method="POST" class="item" id="add-thread-form">
                    <h3>Write a Thread!</h3>
                    <label for="book_name">Book Reference</label>
                    <input type="text" id="book_name" name="book_name">
                    <span id="name-error" class="error-message"></span>

                    <label for="message">Your Thread:</label><br>
                    <textarea id="content" name="message" rows="10" cols="50" placeholder="Type your message here..."></textarea>
                    <span id="message-error" class="error-message"></span>

                    <input type="hidden" name="user_time" id="user_time">
                    <script>
                        const userTime = new Date();
                        const formatted = userTime.toISOString().slice(0, 19).replace("T", " ");
                        document.getElementById('user_time').value = formatted;
                    </script>

                    <button type="submit">Add</button>
                </form>
            </div>



            </div>
        </div>
    </div>

</div>
<script src="js/threads.js"></script>

</body>
</html>

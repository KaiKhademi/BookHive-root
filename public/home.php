<?php
session_start(); // Start the session on the protected page

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // If the user is not logged in, redirect to the login page
    header('Location: index.html');
    exit();
}
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
          <li><a href="home.html">Home</a></li>
          <li><a href="hive.html">Hive</a></li>
          <li><a href="about.html">About</a></li>
        <li class="search">
            <input type="text" placeholder="Search..." class="search-box">
            <button class="search-button">Search</button>
        </li>
        </ul>
      </nav>
        <br>
      <div class="dashboard">
        <div class="bio">
          <img class="profile-image icon" src="images/BookHive-Logo.png"/>
          <h2 class="profile-bio">Welcome, <?php echo $_SESSION["username"];?>!</h2>
            <div>
                <p>Username: <?php echo $_SESSION["username"];?></p>
                <p>Email: <?php echo $_SESSION["email"];?></p>
            </div>
        </div>
        <div class="book">
            <div class="achievments">
                <h2>Achievments</h2>
                <div class="item">
                  <img src="images/achievment-logo.png" alt="achivement" class="icon">
                    <span class="caption">Logging in!</span>
                </div>
            </div>
            <div class="shelf">
                <div class="mybooks">
                    <h2>My Bookshelf</h2>
                    <div class="item">
                      <img src="images/book-logo.png" alt="book" class="icon">
                        <span class="caption">Book 1</span>
                    </div>
                    <div class="item">
                      <img src="images/book-logo.png" alt="book" class="icon">
                        <span class="caption">Book 2</span>
                    </div>
                    <div class="item">
                      <img src="images/book-logo.png" alt="book" class="icon">
                        <span class="caption">Book 3</span>
                    </div>
                </div>
                <div class="otherbooks">
                  <div class="borrowed">
                      <h2>Borrowed Books</h2>
                      <div class="item">
                        <img src="images/book-logo.png" alt="book" class="icon">
                          <span class="caption">Book 1</span>
                      </div>
                      <div class="item">
                        <img src="images/book-logo.png" alt="book" class="icon">
                          <span class="caption">Book 2</span>
                      </div>
                      <div class="item">
                        <img src="images/book-logo.png" alt="book" class="icon">
                          <span class="caption">Book 3</span>
                      </div>
                  </div>
                  <div class="lended">
                      <h2>Lended Books</h2>
                      <div class="item">
                          <img src="images/book-logo.png" alt="book" class="icon">
                          <span class="caption">Book 1</span>
                      </div>
                      <div class="item">
                          <img src="images/book-logo.png" alt="book" class="icon">
                          <span class="caption">Book 2</span>
                      </div>
                      <div class="item">
                          <img src="images/book-logo.png" alt="book" class="icon">
                          <span class="caption">Book 3</span>
                      </div>
                  </div>

                </div>
            </div>
        </div>

      </div>
</body>
</html>

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
$stmt = $pdo->prepare("SELECT * FROM Books WHERE owner_username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
                <div class="mybooks" id="mybooks">
                    <h2>My Bookshelf</h2>
                            <?php
                        foreach ($books as $book) {
                              $book_name = $book["book_name"];
                              echo '<div class="item">
                                      <img src="images/book-logo.png" alt="book" class="icon">
                                      <span class="caption">' . $book_name . '</span>
                                    </div>';
                          }
                      ?>
                    <form action="../includes/add_book.php" method="POST" class="item" id="add-book-form">
                        <h3>Add a Book!</h3>
                        <label for="book_name">Name</label>
                        <input type="text" id="book_name" name="book_name">
                        <span id="name-error" class="error-message"></span>

                        <label for="genre">Genre</label>
                        <select id="genre" name="genre">
                            <option value="classic">Classic</option>
                            <option value="fiction">Fiction</option>
                            <option value="scifi">Sci-Fi</option>
                            <option value="nonfiction">Non-fiction</option>
                            <option value="fantasy">Fantasy</option>
                        </select>

                        <input type="file" id="imageInput" accept="image/*">
                        <img id="preview" src="#" alt="Image Preview" style="display: none; width: 200px; margin-top: 10px;">

                        <button type="submit">Add</button>
                    </form>
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
    <script src="js/homeScript.js"></script>

</body>
</html>

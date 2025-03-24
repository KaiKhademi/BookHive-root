<?php
require_once('connect.php');

$stmt = $pdo->query("SELECT t.title, t.content, t.created_at, u.email FROM threads t JOIN users u ON t.user_id = u.id ORDER BY t.created_at DESC");

$threads = $stmt->fetchAll();

foreach ($threads as $thread) {
    echo "<div class='thread'>";
    echo "<h3>" . htmlspecialchars($thread['title']) . "</h3>";
    echo "<p>" . nl2br(htmlspecialchars($thread['content'])) . "</p>";
    echo "<small>Posted by: " . htmlspecialchars($thread['email']) . " at " . $thread['created_at'] . "</small>";
    echo "<hr>";
    echo "</div>";
}
?>

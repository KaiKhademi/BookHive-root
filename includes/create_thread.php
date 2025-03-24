<?php
require_once('connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id']; // In production, use $_SESSION instead
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (!empty($userId) && !empty($title) && !empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO threads (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $title, $content]);
        echo "Thread created successfully.";
    } else {
        echo "Please fill out all fields.";
    }
}
?>

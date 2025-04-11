<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST');
header('Content-Type: application/json');

// Fake in-memory DB (replace this with real DB queries)
$threadsFile = __DIR__ . '/threads.json';

if (!file_exists($threadsFile)) {
    file_put_contents($threadsFile, json_encode([]));
}

$threads = json_decode(file_get_contents($threadsFile), true);

// Simulate login (in real case, login sets this)
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1; // Simulate login
}

// Handle session check
if (isset($_GET['check_session'])) {
    echo json_encode([
        'logged_in' => isset($_SESSION['user_id']),
        'user_id' => $_SESSION['user_id'] ?? null
    ]);
    exit;
}

// GET: return threads
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($threads);
    exit;
}

// POST: create a thread
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (!$user_id || !$title || !$content) {
        echo json_encode(['error' => 'Missing fields']);
        exit;
    }

    $threads[] = [
        'user_id' => $user_id,
        'title' => htmlspecialchars($title),
        'content' => htmlspecialchars($content),
        'timestamp' => time()
    ];

    file_put_contents($threadsFile, json_encode($threads, JSON_PRETTY_PRINT));
    echo json_encode(['message' => 'Thread posted successfully']);
}

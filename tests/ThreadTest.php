<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../BookHive-root-main/includes/connect.php';

class ThreadTest extends TestCase
{
    protected $pdo;
    protected $userId;
    protected $threadTitle = 'PHPUnit Test Thread';

    protected function setUp(): void
    {
        global $pdo;
        $this->pdo = $pdo;

        // Insert a test user
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, dob) VALUES (?, ?, ?, ?)");
        $stmt->execute(['thread_user', 'threaduser@example.com', password_hash('test', PASSWORD_DEFAULT), '2000-01-01']);
        $this->userId = $this->pdo->lastInsertId();
    }

    public function testCreateThread()
    {
        $stmt = $this->pdo->prepare("INSERT INTO threads (user_id, title, content) VALUES (?, ?, ?)");
        $result = $stmt->execute([$this->userId, $this->threadTitle, 'This is thread content from a PHPUnit test.']);
        $this->assertTrue($result);
    }

    protected function tearDown(): void
    {
        $this->pdo->prepare("DELETE FROM threads WHERE title = ?")->execute([$this->threadTitle]);
        $this->pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$this->userId]);
    }
}

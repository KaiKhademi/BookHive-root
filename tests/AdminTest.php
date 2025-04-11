<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../BookHive-root-main/includes/connect.php';

class AdminTest extends TestCase
{
    protected $userId;

    protected function setUp(): void
    {
        global $pdo;
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, dob) VALUES (?, ?, ?, ?)");
        $stmt->execute(['target_user', 'target@example.com', password_hash('adminpass', PASSWORD_DEFAULT), '1996-06-06']);
        $this->userId = $pdo->lastInsertId();
    }

    protected function tearDown(): void
    {
        global $pdo;
        $pdo->rollBack();
    }

    public function testDeleteUser()
    {
        global $pdo;

        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $result = $stmt->execute([$this->userId]);

        $this->assertTrue($result);
    }
}

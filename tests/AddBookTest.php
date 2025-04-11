<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../BookHive-root-main/includes/connect.php';

class AddBookTest extends TestCase
{
    protected $userId;

    protected function setUp(): void
    {
        global $pdo;
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, dob) VALUES (?, ?, ?, ?)");
        $stmt->execute(['book_user', 'book_user@example.com', password_hash('bookpass', PASSWORD_DEFAULT), '1997-07-07']);
        $this->userId = $pdo->lastInsertId();
    }

    protected function tearDown(): void
    {
        global $pdo;
        $pdo->rollBack();
    }

    public function testAddBook()
    {
        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO books (title, author, user_id) VALUES (?, ?, ?)");
        $result = $stmt->execute(['Test Book', 'Book Author', $this->userId]);

        $this->assertTrue($result);
    }
}

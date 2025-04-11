<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../BookHive-root-main/includes/connect.php';

class ProfileTest extends TestCase
{
    protected $userId;

    protected function setUp(): void
    {
        global $pdo;
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, dob) VALUES (?, ?, ?, ?)");
        $stmt->execute(['profile_test', 'profile_test@example.com', password_hash('profilepass', PASSWORD_DEFAULT), '1998-12-12']);
        $this->userId = $pdo->lastInsertId();
    }

    protected function tearDown(): void
    {
        global $pdo;
        $pdo->rollBack();
    }

    public function testUpdateProfile()
    {
        global $pdo;

        $newEmail = 'updated_profile@example.com';

        $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
        $result = $stmt->execute([$newEmail, $this->userId]);

        $this->assertTrue($result);

        $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
        $stmt->execute([$this->userId]);
        $user = $stmt->fetch();

        $this->assertEquals($newEmail, $user['email']);
    }
}

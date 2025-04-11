<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../BookHive-root-main/includes/connect.php';

class SignupTest extends TestCase
{
    protected $pdo;
    protected $testEmail = 'phpunittest_user@example.com';

    protected function setUp(): void
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function testUserRegistration()
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, dob) VALUES (?, ?, ?, ?)");
        $password = password_hash('testpass123', PASSWORD_DEFAULT);
        $result = $stmt->execute(['phpunit_user', $this->testEmail, $password, '2000-01-01']);
        $this->assertTrue($result);
    }

    protected function tearDown(): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE email = ?");
        $stmt->execute([$this->testEmail]);
    }
}

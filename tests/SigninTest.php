<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../BookHive-root-main/includes/connect.php';

class SigninTest extends TestCase
{
    protected $pdo;
    protected $testEmail = 'phpunittest_login@example.com';
    protected $testPassword = 'validpassword';

    protected function setUp(): void
    {
        global $pdo;
        $this->pdo = $pdo;

        // Ensure test user exists
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, dob) VALUES (?, ?, ?, ?)");
        $hashed = password_hash($this->testPassword, PASSWORD_DEFAULT);
        $stmt->execute(['login_user', $this->testEmail, $hashed, '2000-01-01']);
    }

    public function testLoginWithCorrectCredentials()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$this->testEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($user);
        $this->assertTrue(password_verify($this->testPassword, $user['password']));
    }

    protected function tearDown(): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE email = ?");
        $stmt->execute([$this->testEmail]);
    }
}

<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../BookHive-root-main/includes/connect.php';

class SignupTest extends TestCase
{
    public function testUserRegistration()
    {
        global $pdo;
        $email = 'testuser1@example.com';
        $username = 'testuser1';
        $password = password_hash('password123', PASSWORD_DEFAULT);
        $dob = '1999-01-01';

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, dob) VALUES (?, ?, ?, ?)");
        $result = $stmt->execute([$username, $email, $password, $dob]);

        $this->assertTrue($result);
    }
}

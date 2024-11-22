<?php
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    
    // Test successful login
    public function testLoginSuccess()
    {
        global $db;
        $db = new PDO('mysql:host=localhost;dbname=facultydb', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $postData = [
            'username' => 'admin1',
            'password' => 'abcdef12345',
        ];

        // Simulate a login attempt
        $result = $this->login($postData['username'], $postData['password']);
        
        // Assert that the result is successful and token is returned
        $this->assertArrayHasKey('token', $result);
        $this->assertNotEmpty($result['token']);
    }

    // Test failed login
    public function testLoginFailure()
    {
        global $db;
        $db = new PDO('mysql:host=localhost;dbname=facultydb', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $postData = [
            'username' => 'admin1',
            'password' => 'wrongpassword',
        ];

        // Simulate a login attempt with incorrect password
        $result = $this->login($postData['username'], $postData['password']);
        
        // Assert that the login fails
        $this->assertFalse($result);
    }

    // Make login a method of the class
    private function login($username, $password) {
        global $db; 
        $stmt = $db->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Verify the password using password_verify
        if ($user && password_verify($password, $user['password'])) {
            // Return mock token for testing
            return ['token' => 'mock_token', 'user' => $user];
        }
        
        return false;
    }
}

<?php
require_once __DIR__ . '/../admin_login.php';
use PHPUnit\Framework\TestCase;

class AdminTest extends TestCase
{
    public function testAdminLogin()
    {
        global $db;
        $db = new PDO('mysql:host=localhost;dbname=facultydb', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $postData = [
            'username' => 'admin1',
            'password' => 'abcdef12345',
        ];

        // Simulate login
        $result = adminLogin($postData['username'], $postData['password']);
        
        $this->assertTrue($result);
    }

    // public function testAdminLoginFailure()
    // {
    //     global $db;
    //     $db = new PDO('mysql:host=localhost;dbname=facultydb', 'root', '');
    //     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     $postData = [
    //         'username' => 'admin1',
    //         'password' => 'wrongpassword',
    //     ];

    //     // Simulate failed login attempt
    //     $result = adminLogin($postData['username'], $postData['password']);
        
    //     $this->assertFalse($result);
    // }
} 

// class AdminTest extends TestCase {
//     protected function setUp(): void {
//         require_once __DIR__ . '/../admin_login.php';
//     }

//     public function testAdminLogin() {
//         $username = 'admin1';
//         $password = 'abcdef12345';
//         $result = adminLogin($username, $password);
//         $this->assertTrue($result);
//     }
// }

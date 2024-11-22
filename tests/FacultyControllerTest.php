<?php
require_once __DIR__ . '/../add_faculty.php';
use PHPUnit\Framework\TestCase;

class FacultyControllerTest extends TestCase
{
    // Simulate adding a faculty entry through the web form
    public function testFacultyFormSubmission()
    {
        // Mock POST data
        global $db;
        $db = new PDO('mysql:host=localhost;dbname=facultydb', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $_POST = [
            'name' => 'Alice Green',
            'school' => 'Physics',
            'cabin' => 'D-303',
            'emp_id'=>'1234',
        ];

        // ob_start();  // Capture the output
        //include('../add_faculty.php');
        $output = addFaculty();

        $this->assertStringContainsString($output, "<script>alert('Faculty added successfully!');</script>");
    }
}

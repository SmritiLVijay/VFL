<?php

use PHPUnit\Framework\TestCase;
use PDO;

class DatabaseTest extends TestCase
{
    // Test faculty data insertion into the database
    public function testFacultyInsertion()
    {
        // Set up mock data for insertion
        $facultyData = [
            'name' => 'Jane Smith',
            'school' => 'SCOPE',
            'cabin' => 'B-202',
            'emp_id' => '1234'
        ];

        // Simulate the insertion logic (you can replace with actual logic)
        global $db;
        $db = new PDO('mysql:host=localhost;dbname=facultydb', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->prepare("INSERT INTO faculty (EMP_ID, Faculty_NAME, SCHOOL, Cabin_Detail) VALUES (?, ?, ?, ?)");
        $query->execute([$facultyData['emp_id'], $facultyData['name'], $facultyData['school'], $facultyData['cabin']]);

        // Verify the insertion
        $query = $db->prepare("SELECT * FROM faculty WHERE Faculty_NAME = ?");
        $query->execute([$facultyData['name']]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Ensure result is not empty and matches the inserted data
        $this->assertNotEmpty($result);
        $this->assertEquals($facultyData['name'], $result['Faculty_NAME']);
        $this->assertEquals($facultyData['school'], $result['SCHOOL']);
        $this->assertEquals($facultyData['cabin'], $result['Cabin_Detail']);
    }
}

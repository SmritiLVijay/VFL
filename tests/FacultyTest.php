<?php

use PHPUnit\Framework\TestCase;

class FacultyTest extends TestCase
{
    // Example of testing the addition of a faculty
    public function testAddFaculty()
    {
        // Simulating a faculty entry
        $facultyData = [
            'name' => 'John Doe',
            'school' => 'Computer Science',
            'cabin' => 'C-101',
            'emp_id' => '12345',
        ];

        // Simulate adding faculty using your function or directly invoking logic
        $result = addFaculty($facultyData['name'], $facultyData['school'], $facultyData['cabin'],$facultyData['emp_id']);
        
        // Check if the faculty was added successfully
        $this->assertStringContainsString($result, "<script>alert('Faculty added successfully!');</script>");
        //$this->assertTrue($result);
    }

    // Test the search functionality by school
    // public function testSearchFacultyBySchool()
    // {
    //     // Simulate searching by school
    //     $school = 'Computer Science';
    //     $facultyList = searchFacultyBySchool($school);
        
    //     // Check if the returned list has expected data
    //     $this->assertNotEmpty($facultyList);
    // }
}

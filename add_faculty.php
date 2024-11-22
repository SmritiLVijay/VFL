<?php
// add_faculty.php
function addFaculty(){
include 'database.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $cabin = $_POST['cabin'];
    $school = $_POST['school'];
    $emp_id = $_POST['emp_id'];

    $stmt = $conn->prepare("INSERT INTO faculty (EMP_ID,Faculty_NAME,SCHOOL, Cabin_Detail) VALUES (?, ?,?,?)");
    $stmt->bind_param("ssss", $emp_id,$name, $school,$cabin);

    if ($stmt->execute()) {
        echo "<br><center>Faculty added successfully!</center>";
        echo "<script>alert('Faculty added successfully!');</script>";
        return "<script>alert('Faculty added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding faculty: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
return "<script>alert('Faculty added successfully!');</script>";
}
addFaculty();

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Add Faculty</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&family=Teko:wght@300..700&display=swap&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
        <div class="top-nav">
            <div class="nav-left"><a href="">VFL</a></div>
            <a href="index.php"><i class="fas fa-home"></i></a>
            <a href="https://github.com/SmritiLVijay/VIT-Faculty-Locator"><i class="fa-brands fa-github"></i></a>
            <a href="logout.php">Logout</a>
        </div>
    
    </header>
    <div class="container">
        <h2>Add Faculty</h2>
        <form method="POST" action="add_faculty.php">
            <input type="text" name="emp_id" placeholder="Employee ID" required><br>
            <input type="text" name="name" placeholder="Faculty Name" required><br>
            <input type="text" name="cabin" placeholder="Cabin Details" required><br>
            <input type="text" name="school" placeholder="School" required><br>
            <button type="submit">Add Faculty</button>
        </form>
    </div>
</body>
</html>

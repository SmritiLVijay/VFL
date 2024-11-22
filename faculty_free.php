<?php
include("database.php");
$fac_name="";
if (isset($_POST['fac-name'])) {
    $fac_name = $_POST['fac-name'];
    $stmt = mysqli_prepare($conn, "SELECT * FROM facultyNew WHERE LOWER(name) = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", strtolower($fac_name));
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            print_r($result);
            while ($row = mysqli_fetch_assoc($result)) {
                $fac_name = htmlspecialchars($row['name']);
                $dept_name = htmlspecialchars($row['dept']);
                $cabin_no = htmlspecialchars($row['cabin']);
                $fac_mail = htmlspecialchars($row['email']);
            }
        } else {
            echo "No results found for '" . htmlspecialchars($fac_name) . "'.";
        }
        mysqli_stmt_close($stmt);

}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty free</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&family=Teko:wght@300..700&display=swap"
        rel="stylesheet">

    <title>Faculty Details</title>
    
</head>

<body>
    <header>
        <div class="top-nav">
            <div class="nav-left"><a href="">VFL</a></div>
            <div class="nav-center"><a href="">Faculty details</a></div>
            <a href="index.php"><i class="fas fa-home"></i></a>
            <a href="https://github.com/SmritiLVijay/VIT-Faculty-Locator"><i class="fa-brands fa-github"></i></a>
        </div>
    </header>

        <section class="faculty-profile">
            <div class="faculty-info">
                <h2 id="faculty-name">Dr. <?php echo"$fac_name" ?></h2>
                <p id="faculty-dept"><strong>Specialization:</strong><?php echo " ".$dept_name; ?></p>
                <p id="faculty-cabin"><strong>Cabin Number:</strong><?php echo " ".$cabin_no ?></p>
                <p id="faculty-email"><strong>Contact:</strong><?php echo " ".$fac_mail ?></p>
            </div>
            <button style="display: block; margin: auto;" id="view-timings" onclick="window.location.href='free_timings.html'">View Dr. <?php echo"$fac_name" ?>'s Free Timings</button>
            <br><br>
            <img src="timetable.jpeg" alt="Time table">
        </section>
    <footer>
        <p>&copy; VIT Faculty Locator</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>

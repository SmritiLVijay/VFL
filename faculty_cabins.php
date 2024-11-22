<?php
include("database.php");
$fac_name="";
if (isset($_POST['sch-name'])) {
    $school = $_POST['sch-name'];
    $sql = "SELECT Faculty_NAME, Cabin_Detail,SCHOOL FROM Faculty WHERE LOWER(SCHOOL) = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", strtolower($school));
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $names[] = $row['Faculty_NAME'];
            $cabins[] = $row['Cabin_Detail'];
        }
    }
    $json_names = json_encode($names);
    $json_cabins = json_encode($cabins);
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty cabins</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&family=Teko:wght@300..700&display=swap"
        rel="stylesheet">

    <title>Faculty Directory</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body onload="getTable()">
    <header>
        <div class="top-nav">
            <div class="nav-left"><a href="">VFL</a></div>
            <div class="nav-center" id="School-name-nav"><a href="">Faculty Directory - <?php echo strtoupper($school)?></a></div>
            <a href="index.php"><i class="fas fa-home"></i></a>
            <a href="https://github.com/SmritiLVijay/VIT-Faculty-Locator"><i class="fa-brands fa-github"></i></a>
        </div>

    </header>

        <section class="directory">
            <h2 id="School-name-head">List of Faculty Members - <?php echo strtoupper($school)?></h2>
            <table id="cabin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Cabin Number</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>


    <footer>
        <p>&copy; VIT Faculty Locator</p>
    </footer>
</body>

<script>



// TABLE

function getTable(){
    let table = document.getElementById('cabin-table');
    let facultyNames = <?php echo $json_names ?>;
    let cabinDetails = <?php echo $json_cabins ?>;
    for(let i=0;i<Object.keys(facultyNames).length;i++){
        var row = table.insertRow();
        var cell1 = row.insertCell();
        var cell2 = row.insertCell();
        var cell3 = row.insertCell();
        var cell4 = row.insertCell();
        cell1.innerHTML = facultyNames[i];
        cell2.innerHTML = "<img src=\"pic.webp\">";
        cell3.innerHTML = cabinDetails[i];
        cell4.innerHTML = "9999999999";
    };
}
getTable();
</script>
</html>
<?php
include("database.php");
$sql = "SELECT * FROM facultyNew";
$result = mysqli_query($conn, $sql);
$names = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $names[] = $row['name'];
    }
}
$json_names = json_encode($names);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&family=Teko:wght@300..700&display=swap&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="top-nav">
            <div class="nav-left"><a href="">VFL</a></div>
            <a href="index.php"><i class="fas fa-home"></i></a>
            <a href="https://github.com/SmritiLVijay/VIT-Faculty-Locator"><i class="fa-brands fa-github"></i></a>
            <a onclick="window.location.href='admin_login.php'">Admin</a>
        </div>


    </header>
    <div id="Welcome-banner">
        <div class="banner-text">Vellore Institute <br> of Technology <br>Faculty Locator</div>
    </div>


    <div id="content-container">
        <section class="intro">
            <h2>Find Your Professors Easily</h2>
            <p>Use our dynamic directory to locate your professors' cabins and their free timings today!</p>
        </section>
        <form action="faculty_free.php" method="post">
            <div class="search-div">
                <section class="search-bar">
                    <input id="get-faculty-name" name="fac-name" type="text" placeholder="Search for Faculty..." required>
                    <button type="submit">Search</button>
                </section>
        </form>
        <form autocomplete="off" action="faculty_cabins.php" method="post">
            <section class="search-bar">
                <input id="get-school-name" name="sch-name" type="text" placeholder="Search for Schools..." required>
                <button type="submit">Search</button>
            </section>
        </form>
    </div>
    </div>


    <footer>
        <p>&copy; VIT Faculty Locator</p>
        <p>Kushagra Borse 21BCE5636 |
Mukund Khandelwal 21BCE5866 |
Smriti L Vijay 21BCE5367
</p>
    </footer>

    <script>
        // AUTOCOMPLETE FUNCTION
        function autocomplete(inp, arr) {
            var currentFocus;
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                this.parentNode.appendChild(a);
                for (i = 0; i < arr.length; i++) {
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        b = document.createElement("DIV");
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        b.addEventListener("click", function(e) {
                            inp.value = this.getElementsByTagName("input")[0].value;
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    currentFocus++;
                    addActive(x);
                } else if (e.keyCode == 38) {
                    currentFocus--;
                    addActive(x);
                } else if (e.keyCode == 13) {
                    e.preventDefault();
                    if (currentFocus > -1) {
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                if (!x) return false;
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }
        var facultyNames = <?php echo $json_names ?>;
        var facultyNamesList = [];
        for (let i = 0; i < Object.keys(facultyNames).length; i++) {
            facultyNamesList.push(facultyNames[i]);
        }
        var schoolNamesList = ["SELECT", "SCOPE", "VITSOL", "SENSE", "VFIT", "SCE", "SMEC", "SSL", "SAS", "VITBS"];
        autocomplete(document.getElementById("get-faculty-name"), facultyNamesList);
        autocomplete(document.getElementById("get-school-name"), schoolNamesList);
    </script>

</body>

</html>
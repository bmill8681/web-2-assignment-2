<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>COMP 3512 Assign2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="CSS/search.css">
    <script src="JS/general.js"></script>
    <script src="JS/search.js"></script>
</head>

<body>
    <nav>
        <div class="logo"></div>
        <div class="navlinks">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="search.php" class="active">Browse</a>
            <a href="single-country.php">Countries</a>
            <a href="single-city.php">Cities</a>
            <?php
            session_start();
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                echo '<a href="profile.php">Profile</a>';
                echo '<a href="favorites.php">Favorites</a>';
                echo "<a href='logout.php'>Logout</a>";
            } else {
                echo "<a href='login.php'>Login</a>";
                echo '<a href="signup.php">Signup</a>';
            }
            ?>
        </div>
        <button class="hamburger">
            <i class="fa fa-bars"></i>
        </button>
    </nav>

    <main>
        <div>
            <section id="filterWrapper">
                <h2>Filter By:</h2>
                <button class="FilterClass FilterButtonActive" id="titleFilter">Title</button>
                <button class="FilterClass FilterButton" id="countryFilter">Country</button>
                <button class="FilterClass FilterButton" id="cityFilter">City</button>
                <div id="filterInput">
                    <form action="./search.php" method="get">
                        <input type="text" name="title" placeholder="Search By Title (Leave blank for all photos)" />
                        <button type="submit">Search</button>
                    </form>
                </div>
            </section>
            <section id="searchResults">
                <!-- Actual PHP stuff -->
                <!-- TODO: Sort array of photos by title before echoing photos -->
                <?php
                require "searchHelper.inc.php";

                function addFavsButton($id)
                {
                    // Check if logged in
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        // Check if favorites is part of session
                        if (isset($_SESSION['favorites'])) {
                            $favs = $_SESSION['favorites'];
                            $found = array_search($id, $favs);
                            if (!$found) {
                                echo "<button class='favoritesButton' data-imageid='" . $id . "'>Add To Favorites</button>";
                            } else {
                                echo "<button disabled='true'>Already Saved!</button>";
                            }
                        } else { // If not part of session, add it
                            $_SESSION['favorites'] = array();
                            echo "<button class='favoritesButton' data-imageid='" . $id . "'>Add To Favorites</button>";
                        }
                    } else { // If not logged in, redirect to login page
                        echo "<a href='login.php' ><button>Login to Save</button></a>";
                    }
                }


                $photos = null;
                if (isset($_GET['title'])) {
                    $photoTitle = $_GET['title'];
                    trim($photoTitle, " ");
                    if ($photoTitle == "") {
                        $photos = GetAllPhotos();
                    } else {
                        $photos = GetPhotosByTitle($photoTitle);
                    }
                } else if (isset($_GET['city'])) {
                    $photoCity = $_GET['city'];
                    trim($photoCity, " ");
                    if ($photoCity == "") {
                        $photos = GetAllPhotos();
                    } else {
                        $photos = GetPhotosByCity($photoCity);
                    }
                } else if (isset($_GET['country'])) {
                    $photoCountry = $_GET['country'];
                    trim($photoCountry, " ");
                    if ($photoCountry == "") {
                        $photos = GetAllPhotos();
                    } else {
                        $photos = GetPhotosByCountry($photoCountry);
                    }
                } else {
                    $photos = GetAllPhotos();
                }
                foreach ($photos as $key => $photo) {
                    $path = $photo['Path'];
                    $path = strtolower($path);
                    echo "<div class='PhotoWrapper'>";
                    echo "<section class='PhotoLeft'>";
                    echo "<a href='./single-photo.php?imageid=" . $photo['ImageID'] . "'><img src='https://storage.googleapis.com/photosasg02/square150/" . $path . "' alt='" . $photo['Title'] . "' /></a>";
                    echo "<div><h2>" . $photo['Title'] . "</h2>";
                    echo "<p>" . $photo['ActualCreator'] . "</p>";
                    echo "<section class='PhotoButtons'><a href='./single-photo.php?imageid=" . $photo['ImageID'] . "'>View</a>";
                    addFavsButton($photo['ImageID']);
                    echo "</section></div></section></div>";
                }
                ?>
            </section>
        </div>
    </main>

    <footer>
        <p class="copyright">© COMP 3512 | Brendon - Brett - David - Nhatty | Dec.2019</p>
    </footer>



</body>

</html>
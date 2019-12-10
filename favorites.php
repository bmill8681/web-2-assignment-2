<?php
session_start();

function addPhoto($photo)
{
    $path = $photo['Path'];
    $path = strtolower($path);
    echo "<div class='PhotoWrapper'>";
    echo "<section class='PhotoLeft'>";
    echo "<a href='./single-photo.php?imageid=" . $photo['ImageID'] . "'><img src='https://storage.googleapis.com/photosasg02/square150/" . $path . "' alt='" . $photo['Title'] . "' /></a>";
    echo "<div><h2>" . $photo['Title'] . "</h2>";
    echo "<p>" . $photo['ActualCreator'] . "</p>";
    echo "<section class='PhotoButtons'><button class='removePhoto' data-imageid='" . $photo['ImageID'] . "'>Remove Photo</button>";
    echo "</section></div></section></div>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>COMP 3512 Assign2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="CSS/favorites.css">
    <script src="JS/general.js"></script>
    <script src="JS/favorites.js"></script>
</head>

<body>
    <nav>
        <div class="logo"></div>
        <div class="navlinks">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="search.php">Browse</a>
            <a href="single-country.php">Countries</a>
            <a href="single-city.php">Cities</a>
            <?php
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                echo '<a href="profile.php">Profile</a>';
                echo '<a href="favorites.php" class="active">Favorites</a>';
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
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                if (isset($_SESSION['favorites'])) {
                    $favs = $_SESSION['favorites'];
                    include 'searchHelper.inc.php';
                    if (count($favs) == 0) {
                        echo "<h1>No favorites saved yet!</h1>";
                    } else {
                        echo "<button class='removeAll'>Remove All Photos</button>";
                        echo "<section class='PhotoBox'>";
                        foreach ($favs as $id) {
                            $photo = GetPhotosByID($id);
                            addPhoto($photo);
                        }
                        echo "</section>";
                    }
                } else {
                    echo "<section><h1>No favorites saved yet!</h1></section>";
                }
            }
            ?>
            <div></div>
        </div>
    </main>

    <footer>
        <p class="copyright">© COMP 3512 | Brendon - Brett - David - Nhatty | Dec.2019</p>
    </footer>



</body>

</html>
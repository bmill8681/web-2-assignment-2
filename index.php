<?php

require_once('config.inc.php');
require_once('helper.php');
require_once('setConnection.php');
session_start();

function userInfo()
{

    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];
        $user = userProfile($userId);

        foreach ($user as $u) {

            echo "<table>";
            echo "<tr><th>First Name</th> <td>" . $u['FirstName']  . "</td></tr>";
            echo "<tr><th> Last Name</th> <td>" . $u['LastName']  . "</td></tr>";
            echo "<tr><th>Country</th> <td>" . $u['Country']  . "</td></tr>";
            echo "<tr><th>City</th> <td>" . $u['City']  . "</td></tr>";
            echo "</table>";
        }
    }
}

function  imagesYouLike()
{
    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];
        $user = userProfile($userId);
        foreach ($user as $u) {
            $countryName = $u['Country'];

            $getISO = getCountryISO($countryName);
            //                 print_r($getISO);
            //                 echo $getISO;

            foreach ($getISO as $g) {
                //                       echo $g['ISO'];

                $photosByCountry = photosByCountry($g['ISO']);
                foreach ($photosByCountry as $p) {
                    $path = $p['Path'];
                    $path = strtolower($path);
                    echo "<a href='single-photo.php?imageid=" . $p['ImageID'] . "'>";
                    echo "<img src='https://storage.googleapis.com/photosasg02/square150/" . $path . "'/></a>";
                }
            }
        }
    }
}

function favImages()
{
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['favorites'])) {
            $favs = $_SESSION['favorites'];
            include 'searchHelper.inc.php';
            if (count($favs) == 0) {
                echo "<h1>No favorites saved yet!</h1>";
            } else {

                foreach ($favs as $id) {
                    $photo = GetPhotosByID($id);
                    addPhoto($photo);
                }
            }
        } else {
            echo "<h1>No favorites saved yet!</h1>";
        }
    }
}

function addPhoto($photo)
{
    $path = $photo['Path'];


    echo "<a href='./single-photo.php?imageid=" . $photo['ImageID'] . "'><img src='https://storage.googleapis.com/photosasg02/square150/" . $path . "' alt='" . $photo['Title'] . "' /></a>";
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
    <link rel="stylesheet" href="CSS/index.css">
    <script src="JS/general.js"></script>
    <script src="JS/index.js"></script>
</head>

<body>
    <nav>
        <div class="logo"></div>
        <div class="navlinks">
            <a href="index.php" class="active">Home</a>
            <a href="about.php">About</a>
            <a href="search.php">Browse</a>
            <a href="single-country.php">Countries</a>
            <a href="single-city.php">Cities</a>
            <?php
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
        <?php


        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {

            echo "<main class='mainloggedin'>";
            echo "<div class='containerloggedin'>";

            // echo "<div class='leftContainer'>";
            echo "<div class='userInfo'>";
            echo '<h3>User Info</h3>';
            userInfo();
            echo "</div>";

            echo "<div class='favImages images'>";
            echo '<h3>Favorited Images</h3>';
            favImages();
            // echo "</div>";
            echo "</div>";


            echo "<div class='searchBox'>";
            echo '<h3>Search</h3>';
            echo '<div id="filterInput">
                                    <form action="./search.php" method="get">
                                        <input type="text" class="searchPhoto" name="title" placeholder="Search By Title (Leave blank for all photos)" />
                                    <button class="button" type="submit">Search</button>
                                    </form>
                                    </div>';
            echo "</div>";
            echo "<div class='imagesYouLike images'>";
            echo '<h3>Images You May Like</h3>';
            imagesYouLike();
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</main>";
        } else {
            echo '<main class="mainloggedout">
                    <div class="loggedouthome">
                        <section>
                            <button id="login">Login</button>
                            <button id="join">Join</button>
                            <form class="searchbox" action="./search.php" method="get">
                                <input type="text" name="title" placeholder="Search Photos" />
                                <button type="submit" id="searchbutton">Search</button>
                            </form>
                        </section>
                     </div>
                </main>';
        }


        ?>
    </main>


    <footer>
        <p class="copyright">© COMP 3512 | Brendon - Brett - David - Nhatty | Dec.2019</p>
    </footer>



</body>

</html>
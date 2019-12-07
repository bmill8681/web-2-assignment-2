<?php
require_once('config.inc.php');
require_once('helper.php');
require_once('setConnection.php');

function displayPic()
{
    if (isset($_GET["imageid"])) {

        $imageId = $_GET["imageid"];
        $picDetails = detailForSinglePhoto($imageId);

        foreach ($picDetails as $p) {
            $path = $p['Path'];
            $path = strtolower($path);
            echo "<img class='picInfo' src='https://storage.googleapis.com/photosasg02/medium640/" . $path . "'>";
        }
    }
}
function photoDetails()
{
    if (isset($_GET["imageid"])) {
        $imageId = $_GET["imageid"];
        $picDetails = detailForSinglePhoto($imageId);

        foreach ($picDetails as $p) {
            $countryCode = $p['CountryCodeISO'];
            $Countryname = printNameOfCountry($countryCode);

            $cityCode = $p['CityCode'];
            $cityname = printNameOfCities($cityCode);

            echo "<h1>" . $p['Title'] . "</h1>";
            echo "<div class='titleDetails'>";
            echo "<h2>User ID: " . $p['UserID'] . "</h2>";
            echo "<a href='countryView.php?iso=".$p['CountryCodeISO']."'>";
            echo "<h3>" . $cityname[0]['AsciiName'] . "</h3></a>";
            echo "<a href='cityView.php?iso=" . $p['CityCode'] . "'>";
            echo "<h3>" . $Countryname[0]['CountryName'] . "</h3></a>";
            echo "</div>";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>COMP 3512 Assign2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="CSS/general.css" />
    <link rel="stylesheet" href="CSS/singlePhoto.css" />
    <script src="JS/general.js"></script>
    <!-- <script src="JS/singlePhoto.js"></script> -->
</head>

<body>
    <nav>
        <div class="logo">LOGO</div>
        <div class="navlinks">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="search.php">Browse</a>
            <a href="countryView.php">Countries</a>
            <a href="cityView.php">Cities</a>
            <!-- <a href="profile.php">Profile</a>
            <a href="favorites.php">Favorites</a> -->
            <a href="login.php" class="active">Login</a>
            <a href="signup.php">Signup</a>
            <?php
            if (isset($_SESSION['id'])) {
                echo "<a href='logout.php'>Log Out</a>";
            } else {
                echo "<a href='profile.php'>Profile</a>";
                echo "<a href='favorites.php'>Favorites</a>";
            }

            ?>
        </div>
        <button class="hamburger">
            <i class="fa fa-bars"></i>
        </button>
    </nav>

    <main>
        <div>
            <section class="photoWrapper">
                <?php displayPic(); ?>
            </section>
            <section class="titleWrapper">
                <section>
                    <?php photoDetails();  ?>
                </section>
                <button>Add To Favorites</button>
            </section>
            <section class="detailWrapper">
                Details
            </section>
        </div>
    </main>

    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>
    </footer>

</body>

</html>
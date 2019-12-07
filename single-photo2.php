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
            echo "<h2>  User ID: " . $p['UserID'] . "</h2>";
            echo " <h2> <a href='countryView.php?iso=" . $p['CountryCodeISO'] . "'>" . $Countryname[0]['CountryName'] . "</a></h2>,";
            echo "<h2> <a href='countryView.php?iso=CA'>" . $cityname[0]['AsciiName'] . "</a></h2>";
        }
    }
}

function picDescription()
{
    if (isset($_GET["imageid"])) {
        $imageId = $_GET["imageid"];
        $picDetails = detailForSinglePhoto($imageId);

        foreach ($picDetails as $p) {
            echo "<div class='picDescription1'> <h4>" . $p['Description'] . "</h4> </div>";
            $data = json_decode($p['Exif']);
            echo "<div class='picDetail'>";
            echo "<h3> Make: " . $data->make . "</h3> ";
            echo "<h3> Model: " . $data->model . "</h3> ";
            echo "<h3> exposure_Time: " . $data->exposure_time . "</h3> ";
            echo "<h3> Aperture: " . $data->aperture . "</h3> ";
            echo "<h3> Focal Length: " . $data->focal_length . "</h3> ";
            echo "</div>";
            echo "<picture class='picMap'> <img src='https://maps.googleapis.com/maps/api/staticmap?center=" . $p['Latitude'] . "," . $p['Longitude'] . "&zoom=12&size=500x500&maptype=hybrid&key=AIzaSyCMnhPvJhjCuI6n-8FIjVVPSJLzViJgfq4'></picture>";
        }
    }
}

function displayDetailedInfo()
{
    if (isset($_GET["imageid"])) {
        $imageId = $_GET["imageid"];
        $picDetails = detailForSinglePhoto($imageId);

        foreach ($picDetails as $p) {
            echo "<p>" . $p['Description'] . "</p>";
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="CSS/singlePhoto.css">
    <script src="JS/general.js"></script>
    <script src='JS/singlePhoto.js'></script>
    <title>Single Photo View</title>
</head>

<body>
    <nav class="nav">
        <div class="logo">LOGO</div>
        <div class="navlinks">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="search.php">Browse</a>
            <a href="countryView.php">Countries</a>
            <a href="single-city.php">Cities</a>
            <a href="upload.php">Upload</a>
            <a href="profile.php">Profile</a>
            <a href="favorites.php">Favorites</a>
            <a href="login.php" class="active">Login</a>
            <a href="signup.php">Signup</a>
        </div>
        <button class="hamburger">
            <i class="fa fa-bars"></i>
        </button>
    </nav>

    <main>
        <section id="left">
            <div> <?php displayPic() ?></div>
            <section class="box">
                <?php displayDetailedInfo(); ?>
            </section>
        </section>
        <section id="right">
            <header>
                <section id="photoDetails">
                    <?php photoDetails();  ?>
                </section>
                <section id="photoControls">
                    <button>Add To Favorites</button>
                </section>
            </header>
            <section id="tabContainer">
                <header>
                    <div class="tab tab1">Description</div>
                    <div class="tab details">Details</div>
                    <div class="tab tab3">Map</div>
                </header>
                <section id="info">
                    <?php picDescription(); ?>
                </section>
            </section>
        </section>
    </main>
    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>
    </footer>
</body>

</html>
<?php

require_once('config.inc.php');
require_once('helper.php');
require_once('setConnection.php');

function cityDetail()
{
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        $cities = cityByID($id);

        foreach ($cities as $c) {
            echo "<section class='locationData'>";
            echo "<div><h2>CityName</h2><h3>" . $c['AsciiName'] . "</h3></div>";
            echo "<div><h2>Population</h2><h3>" . $c['Population'] . "</h3></div>";
            echo "<div><h2>Elevation</h2><h3>" . $c['Elevation'] . "</h3></div>";
            echo "<div><h2>Time Zone</h2><h3>" . $c['TimeZone'] . "</h3></div>";
            echo "</section>";
        }
    }
}

function mapDec()
{
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        $cities = cityByID($id);

        foreach ($cities as $c) {
            echo "<picture class='picMap'> <img src='https://maps.googleapis.com/maps/api/staticmap?center=";
            echo $c['Latitude'] . "," . $c['Longitude'] . "&zoom=12&size=475x475&maptype=hybrid&key=AIzaSyCMnhPvJhjCuI6n-8FIjVVPSJLzViJgfq4'></picture>";
        }
    }
}

function displayPicsForCity()
{
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        $photo = pictureForSingleCity($id);
        //        print_r($photo);

        foreach ($photo as $p) {
            $path = $p['Path'];
            $path = strtolower($path);
            //            echo "<a  href='single-photo.php?imageid=" . $p['ImageID'] ". "&cityid=". $p['CityCode']. "&iso=" . $p['CountryCodeISO']. "'> <img src='case-travel-master/images/square150/" . $p['Path'] . "' /> </a>";
            echo "<a  href='single-photo.php?imageid=" . $p['ImageID'] . "'> <img src='https://storage.googleapis.com/photosasg02/square150/" . $path . "' /> </a>";
        }
    }
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
    <link rel="stylesheet" href="CSS/country.css">
    <script src="JS/general.js"></script>
    <script src="JS/countryView.js"></script>
</head>

<body>
    <nav>
        <div class="logo">LOGO</div>
        <div class="navlinks">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="search.php">Browse</a>
            <a href="countryView.php">Countries</a>
            <a href="cityView.php" class="active">Cities</a>
            <?php
                session_start();
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
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
        <div class="container">

            <div class="filters">
                <h4>Country Filters<span id="filtersButton" data-open="false">-</span></h4>
                <section class="filterList">

                    <input type="text" class="search" placeholder="Country Name" list="filterList">
                    <datalist id="filterList"></datalist>
                    <select class="continent">Continent List
                        <option value="">Select Continent</option>
                        <option value="NA">North America</option>
                        <option value="EU">Europe</option>
                        <option value="SA">South America</option>
                        <option value="AF">Africa</option>
                        <option value="AS">Asia</option>
                        <option value="AN">Antarctica</option>
                        <option value="OC">Oceania</option>
                    </select>
                    <div><input type="checkbox" class="imageOnly"> Countries with Images</div>
                    <button class="reset">Reset</button>
                </section>
            </div>

            <div class="countryList">
                <h4>Country List<span id="filtersButton2" data-open="false">-</span></h4>
                <ul class="listCountries" role="listbox"></ul>
            </div>

            <div class="description">
                <h4>City Details<span id="filtersButton3" data-open="false">-</span></h4>
                <?php cityDetail(); ?>
            </div>

            <div class="mapWrapper">
                <h4>Map</h4>
                <section><?php mapDec(); ?></section>
            </div>

            <div class="photo">
                <h4> City Photos</h4>
                <section>
                    <?php displayPicsForCity(); ?>
                </section>
            </div>


        </div>
    </main>

    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>



    </footer>

</body>

</html>
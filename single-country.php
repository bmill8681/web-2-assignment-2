<?php
//linking with the connection and the helper php files!

require_once('config.inc.php');
require_once('helper.php');
require_once('setConnection.php');

if (isset($_GET["iso"])) {
    $iso = $_GET["iso"];
    $country = printSingleCountry($iso);
}


function printDescription()
{
    if (isset($_GET["iso"])) {
        $iso = $_GET["iso"];

        $country = printSingleCountry($iso);

        echo "<section class='locationData'>";
        echo "<div><h2>Country Name</h2> <h3>" . $country['CountryName'] . "</h3></div>";
        echo "<div><h2>Capital</h2><h3>" . $country['Capital'] . "</h3></div>";
        echo "<div><h2>Country Area</h2> <h3>" . $country['Area'] . "</h3></div>";
        echo "<div><h2>Country population</h2><h3>" . $country['Population'] . "</h3></div>";
        echo "<div><h2><th>Continent</h2><h3>" . $country['Continent'] . "</h3></div>";
        echo "<div><h2>Description</h2><h3>" . $country['CountryDescription'] . "</h3></div>";
        echo "</section>";
    } else { }
}

function displayCities()
{
    if (isset($_GET["iso"])) {
        $iso = $_GET["iso"];
        $cities = cityByCountry($iso);
        foreach ($cities as $c) {
            echo "<li><a href='single-city.php?id=" . $c["CityCode"] . "'>" . $c["AsciiName"] . "</a></li>";
        }
    }
}

function displayPhotos()
{
    if (isset($_GET["iso"])) {

        $iso = $_GET["iso"];
        $photo = photosByCountry($iso);
        //        print_r($photo);

        foreach ($photo as $p) {
            $path = $p['Path'];
            $path = strtolower($path);
            echo "<a href='single-photo.php?imageid=" . $p['ImageID'] . "'>";
            echo "<img src='https://storage.googleapis.com/photosasg02/square150/" . $path . "'/></a>";
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
        <div class="logo"></div>
        <div class="navlinks">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="search.php">Browse</a>
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
                <h4>Description<span id="filtersButton3" data-open="false">-</span></h4>
                <section class="descriptionContainer"><?php printDescription(); ?></section>
            </div>
            <div class="cityList">
                <h4>City List</h4>
                <ul><?php displayCities(); ?></ul>
            </div>
            <div class="photo">
                <h4>Photos</h4>
                <section>
                    <?php displayPhotos(); ?>
                </section>
            </div>
        </div>
    </main>

    <footer>
        <p class="copyright">© COMP 3512 | Brendon - Brett - David - Nhatty | Dec.2019</p>
    </footer>

</body>

</html>
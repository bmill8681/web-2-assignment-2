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

        echo "<table style='margin: 10px;'>";
        echo "<tr><th>Country Name</th> <td>" . $country['CountryName'] . "</td></tr>";

        echo "<tr><th>Capital</th> <td>" . $country['Capital'] . "</td></tr>";

        echo "<tr><th>Country Area</th> <td>" . $country['Area'] . "</td></tr>";
        echo "<tr><th>Country population</th> <td>" . $country['Population'] . "</td></tr>";
        echo "<tr><th>Continent</th> <td>" . $country['Continent'] . "</td></tr>";
        echo "<tr><th>Description</th> <td>" . $country['CountryDescription'] . "</td></tr>";
        echo "</table>";
    } else { }
}

function displayCities()
{
    if (isset($_GET["iso"])) {
        $iso = $_GET["iso"];

        $cities = cityByCountry($iso);


        //         echo "<nav>";
        foreach ($cities as $c) {
            echo "<p style='margin: 3px;text-align: center;'><a href='cityView.php?id=" . $c["CityCode"] . "'>" . $c["AsciiName"] . "</a></p>";
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
            echo "<a  style='margin: 20px' href='single-photo.php?imageid=" . $p['ImageID'] . "'> <img src='./images/square150/" . $p['Path'] . "' /> </a>";
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
            <a href="cityView.php">Cities</a>
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
        <div class="container">

            <div class="countryFilter">

                <h4>Country Filters</h4>
                <fieldset>

                    <input type="text" class="search" placeholder="Country Name" list="filterList">
                    <datalist id="filterList">
                    </datalist>
                </fieldset>

                <fieldset>
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
                </fieldset>

                <fieldset>
                    <input type="radio" class="click"><span> Countries with Images</span>
                </fieldset>


                <button type="submit" class="reset">Reset</button>





            </div>

            <div class="countryList">
                <h4 style="margin: 10px;">Country List</h4>
                <section>
                    <ul class="listCountries" role="listbox">
                    </ul>

                </section>

            </div>
            <div class="description">
                <h4>Description</h4>
                <?php printDescription(); ?>
            </div>
            <div class="cityList">

                <h4>City List</h4>

                <?php displayCities(); ?>

            </div>

            <div class="photo">
                <h4 style="margin-bottom: 2em;">Photo</h4>
                <?php displayPhotos(); ?>
            </div>


        </div>
    </main>

    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>



    </footer>

</body>

</html>
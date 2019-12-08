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
            echo "<a href='cityView.php?id=" . $p['CityCode'] . "'>";
            echo "<h3>" . $cityname[0]['AsciiName'] . "</h3></a>";
            echo "<a href='countryView.php?iso=" . $p['CountryCodeISO'] . "'>";
            echo "<h3>" . $Countryname[0]['CountryName'] . "</h3></a>";
            echo "</div>";
        }
    }
}

function hoverPhotoDetails()
{
    if (isset($_GET["imageid"])) {
        $imageId = $_GET["imageid"];
        $picDetails = detailForSinglePhoto($imageId);

        foreach ($picDetails as $p) {
            $data = json_decode($p['Exif']);
            echo "<div class='picDetail2'>";
            if ($data) {
                echo "<h3> Make: " . $data->make . "</h3> ";
                echo "<h3> Model: " . $data->model . "</h3> ";
                echo "<h3> exposure_Time: " . $data->exposure_time . "</h3> ";
                echo "<h3> Aperture: " . $data->aperture . "</h3> ";
                echo "<h3> Focal Length: " . $data->focal_length . "</h3> ";
                $colors = json_decode($p['Colors']);
                echo "<div class='picColorWrapper'> <h3>Colors: </h3>";
                foreach($colors as $color){
                    echo "<div class='picColor' style='background-color: ".$color."'></div>";
                }
                echo"</span></div>";
                echo "</div>";
            } else {
                echo "<p>No Details Available</p></div>";
            }
        }
    }
}

function picDescription()
{
    if (isset($_GET["imageid"])) {
        $imageId = $_GET["imageid"];
        $picDetails = detailForSinglePhoto($imageId);

        foreach ($picDetails as $p) {
            echo "<div class='picDescription'> <p>" . $p['Description'] . "</p> </div>";
            $data = json_decode($p['Exif']);
            echo "<div class='picDetail Hide'>";
            if ($data) {
                echo "<h3> Make: " . $data->make . "</h3> ";
                echo "<h3> Model: " . $data->model . "</h3> ";
                echo "<h3> exposure_Time: " . $data->exposure_time . "</h3> ";
                echo "<h3> Aperture: " . $data->aperture . "</h3> ";
                echo "<h3> Focal Length: " . $data->focal_length . "</h3> ";
                $colors = json_decode($p['Colors']);
                echo "<div class='picColorWrapper'> <h3>Colors: </h3>";
                foreach($colors as $color){
                    echo "<div class='picColor' style='background-color: ".$color."'></div>";
                }
                echo"</span></div>";
                echo "</div>";
            } else {
                echo "<p>No Details Available</p></div>";
            }
            echo "<picture class='picMap Hide'> <img src='https://maps.googleapis.com/maps/api/staticmap?center=" . $p['Latitude'] . "," . $p['Longitude'] . "&zoom=12&size=500x500&maptype=hybrid&key=AIzaSyCMnhPvJhjCuI6n-8FIjVVPSJLzViJgfq4'></picture>";
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
    <script src="JS/singlePhoto.js"></script>
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
        <div>
            <div class="hoverDetails Invisible"><?php hoverPhotoDetails();  ?></div>
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
                <section class="tabContainer">
                    <header>
                        <div class="tab tab1">Description</div>
                        <div class="tab tab2">Details</div>
                        <div class="tab tab3">Map</div>
                    </header>
                    <section id="info">
                        <?php picDescription(); ?>
                    </section>
                </section>
            </section>
        </div>
    </main>

    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>
    </footer>

</body>

</html>
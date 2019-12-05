<?php 
    require_once 'searchHelper.inc.php';
    
    function printPicture($CityCode) {
        $paths = GetPhotosByCity($CityCode);
        foreach($paths as $p) {
            echo '<img src="images/square150/' .$p['Path']. '">';
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
    <link rel="stylesheet" href="CSS/cityView.css">
    <script src="JS/general.js"></script>
    <script src="JS/cityView.js"></script>
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
            <div class="box a">
                <h3>Country Filters:</h3>
            </div>
            <div class="box b">
                <?php 
                    if (isset($_GET['CityCode']) && $_GET['CityCode']) {
                        //print city info
                    }
                ?>
            </div>
            <div class="box c">
            <?php
                if (isset($_GET['CityCode']) && $_GET['CityCode']) {
                    $CityCode = $_GET['CityCode'];
                    printPicture($CityCode);
                }
                ?>
            </div>
            <div class="box d">
                <h3>Countries List</h3>

            </div>
            <div class="box e">
                <img id="map" src="" alt="">
            </div>
        </div>
    </main>

    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>
    </footer>

</body>

</html>
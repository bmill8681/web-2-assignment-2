<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>COMP 3512 Assign2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/general.css">
    <script src="JS/general.js"></script>
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
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
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
        <?php 
            include("favoritesHelper.inc.php");
            echo json_encode(GetUserFavorites(32));
            
        ?>
    </main>

    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>



    </footer>



</body>

</html>
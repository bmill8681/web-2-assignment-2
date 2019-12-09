<?php
    session_start();
    // session_unset();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>COMP 3512 Assign2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="CSS/general.css" />
    <link rel="stylesheet" href="CSS/index.css" />
    <script src="JS/general.js"></script>
    <script src="JS/index.js"></script>
</head>

<body>
    <nav>
        <div class="logo"></div>
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
                if(isset($_SESSION['id'])){
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
            <section>
                <button id="login">Login</button>
                <button id="join">Join</button>
                <form class="searchbox" action="./search.php" method="get">
                    <input type="text" name="title" placeholder="Search Photos" />
                    <button type="submit" id="searchbutton">Search</button>
                </form>
            </section>
        </div>
    </main>

    <footer>
        <p class="copyright">© COMP 3512 Group Assignment | Brendon - Brett - David - Nhatty | December 2019</p>
    </footer>

</body>

</html>
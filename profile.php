<?php

require_once('config.inc.php');
require_once('helper.php');
require_once('setConnection.php');
session_start();


function userInfo()
{
    //        echo session_id();

    if (isset($_SESSION['id'])) {
        //User is logged in
        $userId = $_SESSION['id'];

        //            print_r($userId);
        $user = userProfile($userId);


        foreach ($user as $u) {

            echo "<table>";
            echo "<tr><th>First Name</th> <td>" . $u['FirstName']  . "</td></tr>";
            echo "<tr><th> Last Name</th> <td>" . $u['LastName']  . "</td></tr>";
            echo "<tr><th> Address</th> <td>" . $u['Address']  . "</td></tr>";
            echo "<tr><th>Region</th> <td>" . $u['Region']  . "</td></tr>";
            echo "<tr><th>Country</th> <td>" . $u['Country']  . "</td></tr>";
            echo "<tr><th>City</th> <td>" . $u['City']  . "</td></tr>";
            echo "<tr><th>Postal Code</th> <td>" . $u['Postal']  . "</td></tr>";
            echo "<tr><th>Email</th> <td>" . $u['Email']  . "</td></tr>";
            echo "<tr><th>Phone</th> <td>" . $u['Phone']  . "</td></tr>";

            echo "</table>";
        }
    } else {
        //No one is logged in
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
    <link rel="stylesheet" href="CSS/profile.css">
    <script src="JS/general.js"></script>
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
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                echo '<a href="profile.php" class="active">Profile</a>';
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
            <h1>User Profile</h1>
            <div class='userInfo'>
                <?php userInfo(); ?>
            </div>

        </div>
    </main>

    <footer>
        <p class="copyright">© COMP 3512 | Brendon - Brett - David - Nhatty | Dec.2019</p>
    </footer>



</body>

</html>
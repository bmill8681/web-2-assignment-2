<?php

require_once('config.inc.php');
require_once('helper.php');
require_once('setConnection.php');


function displayPic()
{
    if(isset($_GET["imageid"])){
          
        $imageId = $_GET["imageid"];
//        echo "<div>" .$imageId . "</div>";
         $picDetails = detailForSinglePhoto($imageId); 
        
        //print_r($picDetails);
        foreach($picDetails as $p)
        {   
            echo "<img src='case-travel-master/images/medium640/" . $p['Path'] ."'>";
        }
    }
}


function photoDetails()
{
    if(isset($_GET["imageid"])){
        $imageId = $_GET["imageid"];
        $picDetails = detailForSinglePhoto($imageId); 
        
        foreach($picDetails as $p)
        {
            $countryCode = $p['CountryCodeISO'];
            $cityCode = $p['CityCode'];
            
            //call a function to get a country code and city code
            echo "<h1>" . $p['Title']. "</h1>
                    <h2>  User ID: " . $p['UserID'] . "</h2>
                    <h2><a href='single-country.php?iso=" . $p['CountryCodeISO'] . "'>" . $countryCode . "</a>, City</h2>";
            
        }
    }
    
}

function picDescription()
{
     if(isset($_GET["imageid"])){
          
        $imageId = $_GET["imageid"];
        $picDetails = detailForSinglePhoto($imageId); 
        //print_r($picDetails);
        foreach($picDetails as $p)
        {   
            
            echo "<div class='picDescription1'> <h4>". $p['Description'] ."</h4> </div>";
            
            echo "<div class='picDetail'> <h4>". $p['Exif'] ."</h4> </div>";
          
            
//             echo "<div class='picMap'> <h4> Latitude: ". $p['Latitude'] ."</h4> 
////             <h4> Longitude: ". $p['Longitude'] ."</h4> </div>";
            
//            echo "<picture class='picMap'> <img src='case-travel-master/images/medium640/" . $p['Path'] ."'></picture>";
            
            echo "<picture class='picMap'> <img src='https://maps.googleapis.com/maps/api/staticmap?center=" . $p['Latitude'] . "," . $p['Longitude'] . "&zoom=12&size=500x500&maptype=hybrid&key=AIzaSyCMnhPvJhjCuI6n-8FIjVVPSJLzViJgfq4'></picture>";
            
//             echo "<img src='case-travel-master/images/medium640/" . $p['Path'] ."'>";
            
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
<!--    <link rel="stylesheet" href="CSS/country.css">-->
  <script src="JS/general.js"></script>
   <script src='JS/singlePhoto.js'></script>
    <title>Single Photo View</title>
</head>

<body >
     <nav class="nav">
        <div class="logo">LOGO</div>
        <div class="navlinks">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="search.php">Browse</a>
            <a href="countryView.php">Countries</a>
            <a href="cityView.php">Cities</a>
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
     
    <main >
        <section id="left">
            <div> <?php displayPic() ?></div>
        </section>
        <section id="right" >
            <header>
                <section id="photoDetails">
                   <?php photoDetails();  ?>
<!--
                    <h1>Photo Title</h1>
                    <h2>User Name</h2>
                    <h2>Country, City</h2>
-->
                </section>
                <section id="photoControls">
                    <button>Add To Favorites</button>
                </section>
            </header>
            <section id="tabContainer">
                <header>
                    <div class="tab tab1">Description</div>
                    
                    <div class="tab details">Details</div>
                    
                    <div class="tab tab3">Map
                       
                    </div>
                    
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
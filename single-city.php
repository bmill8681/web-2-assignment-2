

<?php

require_once('config.inc.php');
require_once('helper.php');
require_once('setConnection.php');

function cityDetail()
{
     if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
        
        $cities = cityByID($id);
        
         foreach($cities as $c)
         {
              echo "<p style='margin: 4px;'> CityName: " .$c['AsciiName'] . "</p>";
             echo "<p style='margin: 4px;'> Population: " .$c['Population'] . "</p>";
             echo "<p style='margin: 4px;'> Elevation: " .$c['Elevation'] . "</p>";
             echo "<p style='margin: 4px;'> Time Zone: " .$c['TimeZone'] . "</p>";
             
         }
        
    }
    
}

function mapDec()
{
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
        
        $cities = cityByID($id);
        
         foreach($cities as $c)
         {
              echo "<picture class='picMap'> <img src='https://maps.googleapis.com/maps/api/staticmap?center=" . $c['Latitude'] . "," . $c['Longitude'] . "&zoom=12&size=500x500&maptype=hybrid&key=AIzaSyCMnhPvJhjCuI6n-8FIjVVPSJLzViJgfq4'></picture>";
         }
        
    }
}

function displayPicsForCity()
{
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
        
         $photo = pictureForSingleCity($id);
//        print_r($photo);
        
        foreach ($photo as $p)
        {        
            echo "<a  href='single-photo.php?imageid=" . $p['ImageID'] . "'> <img src='case-travel-master/images/square150/" . $p['Path'] . "' /> </a>";
            
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
    <script src='JS/cityView.js'></script>

</head>

<body>
    <nav class="nav">
        <div class="logo">LOGO</div>
        <div class="navlinks">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="search.php">Browse</a>
            <a href="single-country.php">Countries</a>
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
     
     <main>
         <div class="container">
    
        <div class="countryFilter">

                <h4>City Filters</h4>
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
             <h4>Country List</h4>
                <nav>
                    <ul class="listCountries" role="listbox">
                    </ul>

                </nav>
        
        </div>
        <div class="description">
            <h4>City Details</h4>
            <?php cityDetail(); ?>
        
        </div>
        <div class="cityList">
        
                <h4>Map</h4>
                   <?php mapDec(); ?>
        </div>
        
        <div class="photo">
            <h4> City Photo</h4>
            <?php displayPicsForCity(); ?>
         
        </div>
    
    
    </div>
     
    
     </main>
     
    
     </main>

      

    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>
    </footer>

</body>

</html>
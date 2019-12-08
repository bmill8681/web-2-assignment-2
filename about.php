<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>COMP 3512 Assign2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="CSS/about.css">
    <script src="JS/general.js"></script>
</head>

<body>
    <nav>
        <div class="logo">LOGO</div>
        <div class="navlinks">
            <a href="index.php">Home</a>
            <a href="about.php" class="active">About</a>
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
    
      <div class="div1">
            <h2>COMP 3512-001</h2>
            <h2>Fundamentals of Web Development</h2>
            <h3>Submitted to: Randy Connaly</h3>
            <h3>December 2019</h3>

        </div>
        
         <div>

            <h2>Group members</h2>
            <p>Natnael Beshawered | 3rd year 1st Semester</p>
            <p>Brett Miller | 3rd year 2nd Semester</p>
            <p>David Contreras | 3rd year 1st Semester</p>
            <p>Brendon Hyra | 3rd year 1st Semester</p>

        </div>
        
        
        <div>

            <h2>Technology Used</h2>

            <p>GitHub</p>
            <ul>
                <li> <a href="https://github.com/bmill8681/web-2-assignment-2/tree/master">Master Branch</a></li>
                <li><a href="https://github.com/bmill8681/web-2-assignment-2/tree/nhatty">Natnael</a></li>
                <li> <a href="https://github.com/bmill8681/web-2-assignment-2/tree/brett">Brett</a></li>
                <li> <a href="https://github.com/bmill8681/web-2-assignment-2/tree/david">David</a></li>
                <li> <a href="https://github.com/bmill8681/web-2-assignment-2/tree/brendon">Brendon GitHub</a></li>
            </ul>
 

        </div>
        
        <div class="description">
            
        </div>

    </main>

    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>

    </footer>



</body>

</html>
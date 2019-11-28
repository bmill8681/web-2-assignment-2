<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>COMP 3512 Assign2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/general.css">
    <link rel="stylesheet" href="CSS/search.css">
    <script src="JS/general.js"></script>
</head>

<body>
    <nav>
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

    <main>
        <div>
            <section id="filterWrapper">
                <h2>Filter By:</h2>
                <div class="FilterButtonActive"><h3>Title</h3></div>
                <div class="FilterButton"><h3>Country</h3></div>
                <div class="FilterButton"><h3>City</h3></div>
                <div id="filterInput">Input</div>
            </section>
            <section id="searchResults">
                <h1>Search Results</h1>
                <?php
                require "searchHelper.inc.php";
                if (isset($_GET['title'])) {
                    GetPhotosByTitle($_GET['title']);
                } else
                    GetAllPhotos();
                ?>
            </section>
        </div>
    </main>

    <footer>
        <p class="copyright">© Group Assignment : Group Name : December 2019</p>
    </footer>



</body>

</html>